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

Route::domain('{section}.guia.uffs')->group(function (){
	Route::get('/', 'PublicController@home');
    Route::get('{page}', 'PublicController@page');
});

Route::get('/', 'PublicController@home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
