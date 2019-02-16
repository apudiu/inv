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
})->middleware('auth');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('/clients')->group(function () {
    Route::get('/', 'ClientController@index')->name('clients');
    Route::get('/add', 'ClientController@create')->name('clients.create');
    Route::post('/store', 'ClientController@store')->name('clients.store');
    Route::get('/show/{id}', 'ClientController@show')->name('clients.show');
    Route::get('/edit/{id}', 'ClientController@edit')->name('clients.edit');
    Route::patch('/edit/{id}', 'ClientController@update')->name('clients.update');
    Route::delete('/delete/{id}', 'ClientController@destroy')->name('clients.delete');
});

Route::prefix('/persons')->group(function () {
    Route::get('/add/{clientId}', 'PersonController@create')->name('persons.create');
    Route::post('/store', 'PersonController@store')->name('persons.store');
    Route::get('/show/{id}', 'PersonController@show')->name('persons.show');
    Route::get('/edit/{id}', 'PersonController@edit')->name('persons.edit');
    Route::patch('/edit/{id}', 'PersonController@update')->name('persons.update');
    Route::delete('/delete/{id}', 'PersonController@destroy')->name('persons.delete');

    // ajax
    Route::get('/by_client/{clientId}', 'PersonController@getPersonsByClient');
});

Route::prefix('/invoices')->group(function () {
    Route::get('/', 'InvoiceController@index')->name('invoices');
    Route::get('/add', 'InvoiceController@create')->name('invoices.create');
    Route::post('/store', 'InvoiceController@store')->name('invoices.store');
    Route::get('/show/{id}', 'InvoiceController@show')->name('invoices.show');
    Route::get('/edit/{id}', 'InvoiceController@edit')->name('invoices.edit');
    Route::patch('/edit/{id}', 'InvoiceController@update')->name('invoices.update');
    Route::delete('/delete/{id}', 'InvoiceController@destroy')->name('invoices.delete');

    // estimates
    Route::get('/estimates', 'InvoiceController@indexEstimate')->name('estimates');
    Route::get('/estimates/show/{id}', 'InvoiceController@showEstimate')->name('estimates.show');
});

Route::prefix('/projects')->group(function () {
    Route::get('/', 'ProjectController@index')->name('projects');
    Route::get('/add', 'ProjectController@create')->name('projects.create');
    Route::post('/store', 'ProjectController@store')->name('projects.store');
    Route::get('/show/{id}', 'ProjectController@show')->name('projects.show');
    Route::get('/edit/{id}', 'ProjectController@edit')->name('projects.edit');
    Route::patch('/edit/{id}', 'ProjectController@update')->name('projects.update');
    Route::delete('/delete/{id}', 'ProjectController@destroy')->name('projects.delete');
});
