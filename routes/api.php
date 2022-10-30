<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\SponsorshipController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
   return $request->user();
 });


Route::namespace('Api')->group(function () {
    Route::get("/flats", 'FlatController@index');
    Route::get("/flats/{id}", 'FlatController@show');
});


Route::namespace('api')->group(function(){
    Route::get('/flats', 'FlatController@index');
    Route::get('/flats/{id}', 'FlatController@show');
    Route::get('/sponsorships','SponsorshipController@index');
    Route::get('/generate','OrderController@generate');
    Route::post('/make/payment','OrderController@makePayment');

});