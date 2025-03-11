<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthControloler;
use App\Http\Controllers\ItineraryController;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\DishController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ActivityController;
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
    // Auth routes
    Route::post('/logout', [AuthControloler::class, 'logout'])->name('logout');

    // Itinerary routes
    Route::post('/itinerary/add', [ItineraryController::class, 'store'])->name('create.itinerary');
    Route::patch('/itinerary/update/{id}', [ItineraryController::class, 'update'])->name('update.itinerary');
    Route::post('/itinerary/delete/{id}', [ItineraryController::class, 'destroy'])->name('create.itinerary');

    // Destination routes
    Route::post('/destination/add/{id}', [DestinationController::class, 'store'])->name('create.destination');
    Route::get('/destination/show', [DestinationController::class, 'listDestinations'])->name('list.destination');
    Route::patch('/destination/update/{id}', [DestinationController::class, 'update'])->name('update.destination');
    Route::post('/destination/delete/{id}', [DestinationController::class, 'destroy'])->name('destination.delete');

    // Dish routes
    Route::post('/dish/add/{id}', [DishController::class, 'store'])->name('add.dish');
    Route::get('/dish/all', [DishController::class, 'showAllDishes'])->name('list.dish');
    Route::patch('/dish/update/{id}', [DishController::class, 'update'])->name('update.dish');
    Route::post('/dish/delete/{id}', [DishController::class, 'destroy'])->name('delete.dish');

    // Activity routes
    Route::post('/activity/add/{destination_id}', [ActivityController::class, 'store'])->name('add.activity');
    Route::get('/activities/{destination_id}', [ActivityController::class, 'index'])->name('show.activities');
    Route::patch('/activity/update/{id}', [ActivityController::class, 'update'])->name('update.activity');
    Route::delete('/activity/{id}', [ActivityController::class, 'destroy'])->name('delete.activity');

    // Wishlist routes
    Route::post('/wishlist/itinerary/{itinerary_id}', [WishlistController::class, 'store'])->name('add.wishlist');
    Route::get('/wishlist/itineraries', [WishlistController::class, 'index'])->name('show.wishlist');
    Route::delete('/wishlist/itinerary/{itinerary_id}', [WishlistController::class, 'destroy'])->name('delete.wishlist');

    // Review routes
    Route::post('/review/itinerary/{itinerary_id}', [ReviewController::class, 'store'])->name('add.review');
    Route::get('/review/itineraries', [ReviewController::class, 'index'])->name('show.reviews');
    Route::delete('/review/itinerary/{itinerary_id}', [ReviewController::class, 'destroy'])->name('delete.review');
});
Route::post('/register', [AuthControloler::class, 'register'])->name('register');
Route::post('/login', [AuthControloler::class, 'login'])->name('login');

// show the itineraries
Route::get('itinerary/all', [ItineraryController::class , 'listAllItineraries'])->name('list.itiniraries');
