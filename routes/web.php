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
    Route::get('{page}', 'PublicController@page')->name('page');
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

	Route::group(['prefix' => 'editor',  'middleware' => 'auth'], function (){
		Route::get('/', 'EditorController@index')->name('editor');
		Route::post('paginas', 'PageController@store')->name('pages.store');
		Route::get('paginas', 'PageController@index')->name('pages.index');
		Route::get('paginas/criar', 'PageController@create')->name('pages.create');
		Route::put('paginas/{id}', 'PageController@update')->name('pages.update');
		Route::get('paginas/{id}', 'PageController@show')->name('pages.show');
		Route::delete('paginas/{id}', 'PageController@destroy')->name('pages.destroy');
		Route::get('paginas/{id}/editar', 'PageController@edit')->name('pages.edit');
	});

	Route::group(['prefix' => 'admin',  'middleware' => ['auth', 'admin']], function (){
		Route::get('/', 'AdminController@index')->name('admin');
		Route::post('secoes', 'SectionController@store')->name('sections.store');
		Route::get('secoes', 'SectionController@index')->name('sections.index');
		Route::get('secoes/criar', 'SectionController@create')->name('sections.create');
		Route::put('secoes/{id}', 'SectionController@update')->name('sections.update');
		Route::get('secoes/{id}', 'SectionController@show')->name('sections.show');
		Route::delete('secoes/{id}', 'SectionController@destroy')->name('sections.destroy');
		Route::get('secoes/{id}/editar', 'SectionController@edit')->name('sections.edit');
	});

	Route::get('{page}', function ($page){
		return app('App\Http\Controllers\PublicController')->page('', $page);
	})->name('main.page');
});
