<?php

namespace App\Http\Controllers;
use App\Models\dish;
use Illuminate\Http\Request;

class DishController extends Controller
{
    public function store(Request $request , $id){
        $request->validate([
            'name'  =>     'required',
            'description' =>    'required'
        ]);
        $createDish = dish::create([
            'destination_id'    =>  $id,
            'name'              =>  $request->name,
            'description'       =>  $request->description
        ]);
        // check if the dish is created
        if($createDish){
            return response()->json([
               "message"    =>  "the Dish has been set successfully!"
            ] , 200);
        }else{
            return response()->json([
                "message"    =>  "There was an error creating dish, please try again"
            ] , 500);
        }
    }

    // show all the dishes
    public function showAllDishes(){
        $allDishes = dish::all();
        return $allDishes;
    }

    // update dishes
    public function update(Request $request , $id){
        $dish = dish::findOrFail($id);
        // validate the data
        $valideData = $request->validate([
            'name'          => 'string|min:3',
            'description'   =>  'string'
        ]);
        $dish->update($valideData);
        return response()->json([
            'message'   =>  "the dish has been updated"
        ]);
    }

    // delete the dish
    public function destroy($id){
        $delete = dish::destroy($id);
        if ($delete){
            return response()->jsno([
                'message'   =>  'The dish has been deleted ! '
            ]);
        }else{
            return response()->json([
                'message'   =>  'there must be an error while deleteing the dish, or it could be really deleted'
            ]);
        }
    }
}
