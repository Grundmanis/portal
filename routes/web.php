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
Route::get('/{locale?}', 'HomeController@index');

// TODO change to current locale
Route::group(['prefix' => 'lv'], function() {

// Auth
    Auth::routes();
    Route::get('/login/{service}', 'Auth\LoginController@redirectToProvider');
    Route::get('/login/{service}/callback', 'Auth\LoginController@handleProviderCallback');

// Create category
    Route::get('/add-category', 'CategoryController@create');
    Route::post('/add-category', 'CategoryController@store')->name('category.store');
});