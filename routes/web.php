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

Route::get('/', 'HomeController@index');
Route::get('/adverts/{category}/{subcategory}/', 'AdvertController@index')->name('adverts');
Route::get('/adverts/{category}/{subcategory}/{advert}/', 'AdvertController@show')->name('adverts.show');
Route::get('/adverts/add/', 'AdvertController@create')->name('adverts.create')->middleware('auth');
Route::post('/adverts/add/', 'AdvertController@store')->middleware('auth');

Auth::routes();
Route::get('/login/{service}', 'Auth\LoginController@redirectToProvider');
Route::get('/login/{service}/callback', 'Auth\LoginController@handleProviderCallback');