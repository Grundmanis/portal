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
Route::get('/', 'CategoryController@categories');

// Create category
Route::group(['prefix' => '/categories'], function(){
    Route::get('/', 'CategoryController@categories');
    Route::get('/create', 'CategoryController@create')->name('category.create');
    Route::post('/create', 'CategoryController@store')->name('category.store');
//    Route::get('/{category}/{subcategory?}/{childsubcategory?}', 'CategoryController@index')->name('category.index');
    Route::get('/{categories}', 'CategoryController@index')->where('categories', '(.*)')->name('category.index');
});

// Auth
Auth::routes();
Route::get('/login/{service}', 'Auth\LoginController@redirectToProvider');
Route::get('/login/{service}/callback', 'Auth\LoginController@handleProviderCallback');

// Create category filter
Route::get('/filters/{category}/{subcategory}', 'FilterController@show')->name('filter.show');
Route::get('/add-filter', 'FilterController@create')->name('filter.create');
Route::post('/add-filter', 'FilterController@store')->name('filter.store');

// Create advert
Route::get('/add-advert', 'AdvertController@create')->name('advert.create');
Route::post('/add-advert', 'AdvertController@store')->name('advert.store');

Route::get('/image', function()
{
    $img = Image::make('http://pre07.deviantart.net/7dbb/th/pre/i/2009/155/6/a/patrick_star_by_ninjasaus.png')->resize(300, 200);
    return $img->response('jpg');
});