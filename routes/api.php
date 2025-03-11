<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthControloler;
use App\Http\Controllers\ItineraryController;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\DishController;
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
    Route::get('/destination/show' , [DestinationController::class , 'listDestinations'])->name('list.destination');
    Route::post('/destination/delete/{id}',[DestinationController::class , 'destroy'])->name('destination.delete');
    Route::post('/dish/add/{id}' , [DishController::class , 'store'])->name('add.dish');
    Route::get('/dish/all' , [DishController::class , 'showAllDishes'])->name('list.dish');
    Route::patch('/dish/update/{id}' , [DishController::class , 'update'])->name('update.dish');
    Route::post('/dish/delete/{id}' , [DishController::class , 'destroy'])->name('delete.dish');
});
Route::post('/register', [AuthControloler::class, 'register'])->name('register');

// show the itineraries
Route::get('itinerary/all', [ItineraryController::class , 'listAllItineraries'])->name('list.itiniraries');
