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

// Authentication Routes...
Route::get('entrar', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('entrar', 'Auth\LoginController@login');
Route::post('sair', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
Route::get('contribuir', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('contribuir', 'Auth\RegisterController@register');

// Password Reset Routes...
Route::get('senha/redefinir', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('senha/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('senha/redefinir/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('senha/redefinir', 'Auth\ResetPasswordController@reset');

Route::get('/home', 'HomeController@index')->name('home');
