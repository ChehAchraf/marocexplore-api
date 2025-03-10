<?php

namespace App\Http\Controllers;
use App\Models\itinerary;
use Illuminate\Http\Request;

class ItineraryController extends Controller
{
    public function store(Request $request){
        $request->validate();
    }
}
