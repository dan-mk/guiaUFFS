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
	Route::get('/', 'PublicController@home')->name('home');
    Route::get('{page}', 'PublicController@page');
});

Route::domain('guia.uffs')->group(function (){
	Route::get('/', 'PublicController@home')->name('main.home');

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

	Route::get('sobre', function (){
		return view('about');
	})->name('about');

	Route::prefix('editor')->group(function (){
		Route::get('/', 'EditorController@pages')->name('editor.pages');
		Route::get('grupos', 'EditorController@groups')->name('editor.groups');
	    Route::resource('paginas', 'PageController');
	});

	Route::get('{page}', 'PublicController@page');
});
