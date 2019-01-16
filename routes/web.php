<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('/clients')->group(function () {
    Route::get('/', 'ClientController@index')->name('clients');
    Route::get('/add', 'ClientController@create')->name('clients.create');
    Route::post('/store', 'ClientController@store')->name('clients.store');
});
