<?php

namespace App\Http\Controllers;
use App\Models\itinerary;
use http\Client\Curl\User;
use Illuminate\Http\Request;

class ItineraryController extends Controller
{
    public function store(Request $request){
        // the user id who is logged in 🙂
        $user_id = auth()->id();
        // valdiate data
        $request->validate([
            'title'     =>      'required|string|min:6',
            'duration'  =>      'numeric|required',
            'image'     =>      'required',
//            'user_id'   =>      'numeric'
        ]);
        // create the itinerary 👍
        $createItinerary =  itinerary::create([
            'user_id'   =>      $user_id,
            'title'     =>      $request->title,
            'duration'  =>      $request->duration,
            'image'     =>      $request->image
        ]);
        // check if the creation was successful 🤞🙂
        if ($createItinerary){
            return response()->json([
                'message'   =>      'The itenerary was Created successfully !'
            ] , 200);
        }else{
            return response()->json([
                'message' => "failed to create, There must be an error !"
            ],500);
        }
    }

    
}
