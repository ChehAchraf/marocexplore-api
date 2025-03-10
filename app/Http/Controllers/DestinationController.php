<?php

namespace App\Http\Controllers;
use App\Models\destination;
use http\Env\Response;
use Illuminate\Http\Request;

class DestinationController extends Controller
{
    public function store(Request $request , $id){
        // validate the inputs
        $request->validate([
            'name'          =>  'required',
            'location'      =>  'required',
            'accommodation' =>  'required'
        ]);
        // create the destination
        $createDestination = destination::create([
            'itinerary_id'  =>  $id,
            'name'          =>  $request->name,
            'location'      =>  $request->location,
            'accommodation' =>  $request->accommodation
        ]);
        // check if the created was done
        if($createDestination){
            return response()->json([
                'message'   =>  "The destination was creates successfully "
            ] , 200);
        }else{
            return response()->json([
                'message'   =>  "there must be an error, try again please"
            ] , 500);
        }
    }
}
