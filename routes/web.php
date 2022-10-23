<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

Route::middleware('auth')
    ->prefix('admin')
    ->namespace('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/', 'HomeController@index')->name('home');
        Route::patch('/flats/{flat}/toggle', 'FlatController@toggle')->name('flats.toggle');
        Route::resource('flats', 'FlatController');
    });

Route::get('/', function () {
    return view('guest.home');
});





    // Auth::routes();

    // Route::get('/home', 'HomeController@index')->name('home');
