<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\ProfilePassport;
use App\Http\Controllers\ArtistController;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\FollwersController;
use App\Http\Controllers\EventAndTourController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

 

/**
 * =====================================  wallet route group controller    =======================================
 */
Route::controller(WalletController::class)->group(function() {
    Route::get('/wallet', 'index')->name("wallet.index");
    Route::post('/wallet/store', 'store')->name("wallet.store");

});


/**
 * =====================================  wallet route group controller    =======================================
 */
Route::controller(FollowerController::class)->group(function() {
    Route::get('/follwers', 'index')->name("follwers.index");
    Route::post('/follwers/store', 'store')->name("follwers.store");
    Route::delete('/follwers/destroy/{follower}', 'destroy')->name("follwers.destroy");

});


/**
 * =====================================  event and tour route group controller   =======================================
 */
Route::controller(EventAndTourController::class)->group(function() {
    Route::get('/event-and-tours', 'index')->name("eventAndTours.index");
    Route::post('/event-and-tours/store', 'store')->name("eventAndTours.store");
    Route::get('/event-and-tours/edit/{eventAndTour}', 'edit')->name("eventAndTours.edit");
    Route::put('/event-and-tours/update/{eventAndTour}', 'update')->name("eventAndTours.update");
    Route::delete('/event-and-tours/destroy/{eventAndTour}', 'destroy')->name("eventAndTours.destroy");

});
/** ========================= User Registration Route  ================================== */
Route::controller(UserController::class)->group(function () {
    Route::get('/users', 'index')->name('user.index');
});

/**
 * ===================================== Profile Passport Routes  =======================================
 */

Route::controller(ProfilePassport::class)->group(function () {
    Route::post('/save-profile-passport/store', 'store')->name('profilePassport.store');
});

/**
 * ========================== Genre Routes =================================
 */

Route::controller(GenreController::class)->group(function () {
    Route::get('/genres', 'index')->name('genre.index');
    Route::post('/genre/store', 'store')->name('genre.index');
    Route::get('/genre/edit/{genre}', 'edit')->name('genre.edit');
    Route::put('/genre/update/{genre}', 'update')->name('genre.index');
    Route::delete('/genre/delete/{genre}', 'destroy')->name('genre.delete');
    Route::patch('/genre/restore/{genre}', 'restore')->withTrashed()->name('genre.restore');
});

/**
 * =============================== Artist Routes =============================
 */

 Route::controller(ArtistController::class)->group(function () {
     Route::get('/artsts', 'index')->name('artist.index');
     Route::post('/artist/store', 'store')->name('artist.store');
     Route::get('/artst/edit/{artist}', 'edit')->name('artist.edit');
     Route::put('/artist/update/{artist}', 'update')->name('artist.update');
     Route::delete('/artist/delete/{artist}', 'destroy')->name('artist.delete');
 });
