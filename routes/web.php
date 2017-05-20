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
Route::get('/', 'CategoryController@index');

// Categories
Route::group(['prefix' => 'category'], function(){
    Route::group(['middleware' => 'admin'], function(){
        Route::get('/create', 'CategoryController@create')->name('category.create');
        Route::post('/create', 'CategoryController@store')->name('category.store');
    });
    Route::get('/', 'CategoryController@index');
    Route::get('/{categories}', 'CategoryController@categories')->where('categories', '(.*)')->name('category.categories');
});

// Auth
Auth::routes();
Route::get('/login/{service}', 'Auth\LoginController@redirectToProvider');
Route::get('/login/{service}/callback', 'Auth\LoginController@handleProviderCallback');

// Category filters
Route::get('/filters/{category}/{subcategory}', 'FilterController@show')->name('filter.show');
Route::get('/add-filter', 'FilterController@create')->name('filter.create');
Route::post('/add-filter', 'FilterController@store')->name('filter.store');

// Adverts
Route::group(['prefix' => 'advert', 'middleware' => 'auth'], function(){
    Route::get('create', 'AdvertController@create')->name('advert.create');
    Route::post('create', 'AdvertController@store')->name('advert.store');
    Route::get('{advert}/delete', 'AdvertController@destroy')->name('advert.destroy')->middleware('can:delete,advert');
});
