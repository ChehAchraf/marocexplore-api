<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Destination;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function index($destination_id)
    {
        $activities = Activity::where('destination_id', $destination_id)->get();

        return response()->json([
            'status' => true,
            'data' => $activities
        ]);
    }

    public function store(Request $request, $destination_id)
    {
        // Validate request
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string'
        ]);

        // Check if destination exists
        $destination = Destination::find($destination_id);
        
        if (!$destination) {
            return response()->json([
                'status' => false,
                'message' => 'Destination not found'
            ], 404);
        }

        // Create activity
        $activity = Activity::create([
            'destination_id' => $destination_id,
            'name' => $request->name,
            'description' => $request->description
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Activity added successfully',
            'data' => $activity
        ], 201);
    }

    public function destroy($id)
    {
        $activity = Activity::find($id);

        if (!$activity) {
            return response()->json([
                'status' => false,
                'message' => 'Activity not found'
            ], 404);
        }

        $activity->delete();

        return response()->json([
            'status' => true,
            'message' => 'Activity deleted successfully'
        ]);
    }
}
