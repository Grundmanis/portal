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
Route::get('/categories/', 'CategoryController@index')->name('categories');
Route::get('/categories/adverts/', 'AdvertController@index')->name('categories.adverts');

Auth::routes();
Route::get('/login/{service}', 'Auth\LoginController@redirectToProvider');
Route::get('/login/{service}/callback', 'Auth\LoginController@handleProviderCallback');