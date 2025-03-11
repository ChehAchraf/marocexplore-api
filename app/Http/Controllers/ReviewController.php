<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Itinerary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::with('itinerary')
            ->where('user_id', Auth::id())
            ->get();

        return response()->json([
            'status' => true,
            'data' => $reviews
        ]);
    }

    public function store(Request $request, $itinerary_id)
    {
        // Validate the rating
        $request->validate([
            'rating' => 'required|integer|min:1|max:5'
        ]);

        // Check if itinerary exists
        $itinerary = Itinerary::find($itinerary_id);
        
        if (!$itinerary) {
            return response()->json([
                'status' => false,
                'message' => 'Itinerary not found'
            ], 404);
        }

        // Check if user already reviewed this itinerary
        $exists = Review::where('user_id', Auth::id())
            ->where('itinerary_id', $itinerary_id)
            ->exists();

        if ($exists) {
            return response()->json([
                'status' => false,
                'message' => 'You have already reviewed this itinerary'
            ], 400);
        }

        // Create the review
        $review = Review::create([
            'user_id' => Auth::id(),
            'itinerary_id' => $itinerary_id,
            'rating' => $request->rating
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Review added successfully',
            'data' => $review
        ], 201);
    }

    public function destroy($itinerary_id)
    {
        $review = Review::where('user_id', Auth::id())
            ->where('itinerary_id', $itinerary_id)
            ->first();

        if (!$review) {
            return response()->json([
                'status' => false,
                'message' => 'Review not found'
            ], 404);
        }

        $review->delete();

        return response()->json([
            'status' => true,
            'message' => 'Review deleted successfully'
        ]);
    }
}
