<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use App\Models\Itinerary;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlists = Wishlist::with('itinerary')
            ->where('user_id', Auth::id())
            ->get();

        return response()->json([
            'status' => true,
            'data' => $wishlists
        ]);
    }

    public function store($itinerary_id)
    {
        // Check if itinerary exists
        $itinerary = Itinerary::find($itinerary_id);
        
        if (!$itinerary) {
            return response()->json([
                'status' => false,
                'message' => 'Itinerary not found'
            ], 404);
        }

        // Check if already in wishlist
        $exists = Wishlist::where('user_id', Auth::id())
            ->where('itinerary_id', $itinerary_id)
            ->exists();

        if ($exists) {
            return response()->json([
                'status' => false,
                'message' => 'Itinerary already in wishlist'
            ], 400);
        }

        // Add to wishlist
        $wishlist = Wishlist::create([
            'user_id' => Auth::id(),
            'itinerary_id' => $itinerary_id
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Added to wishlist successfully',
            'data' => $wishlist
        ], 201);
    }

    public function destroy($itinerary_id)
    {
        $wishlist = Wishlist::where('user_id', Auth::id())
            ->where('itinerary_id', $itinerary_id)
            ->first();

        if (!$wishlist) {
            return response()->json([
                'status' => false,
                'message' => 'Wishlist item not found'
            ], 404);
        }

        $wishlist->delete();

        return response()->json([
            'status' => true,
            'message' => 'Removed from wishlist successfully'
        ]);
    }
}
