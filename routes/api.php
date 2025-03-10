<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthControloler;
use App\Http\Controllers\ItineraryController;
use App\Http\Controllers\DestinationController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
// get the user information
    Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
        return $request->user();
    });
// the protected routes asat 😎
Route::group(['middleware'=>['auth:sanctum']], function(){
    Route::post('/itinerary/add' , [ItineraryController::class , 'store'])->name('create.itinerary');
    Route::post('/itinerary/delete/{id}' , [ItineraryController::class , 'destroy'])->name('create.itinerary');
    Route::post('/destination/add/{id}' , [DestinationController::class , 'store'])->name('create.destination');
});
Route::post('/register', [AuthControloler::class, 'register'])->name('register');

// show the itineraries
Route::get('itinerary/all', [ItineraryController::class , 'listAllItineraries'])->name('list.itiniraries');
