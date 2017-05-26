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

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect']
], function() {

    Route::get('/', 'CategoryController@index');

    // Auth
    Auth::routes();
    Route::get('/login/{service}', 'Auth\LoginController@redirectToProvider');
    Route::get('/login/{service}/callback', 'Auth\LoginController@handleProviderCallback');

    // Categories
    Route::group(['prefix' => 'category'], function(){
        Route::group(['middleware' => 'admin'], function(){
            Route::get('/create', 'CategoryController@create')->name('category.create');
            Route::post('/create', 'CategoryController@store')->name('category.store');
            Route::get('{category}/delete', 'CategoryController@destroy')->name('category.destroy');
        });
        Route::get('/{categories}', 'CategoryController@categories')->where('categories', '(.*)')->name('category.categories');
    });

    // Filters
    Route::group(['prefix' => 'filter', 'middleware' => 'admin'], function(){
        Route::get('{category_slug}/{subcategory_slug}', 'FilterController@show')->name('filter.show');
        Route::get('create', 'FilterController@create')->name('filter.create');
        Route::post('create', 'FilterController@store')->name('filter.store');
    });

    // Adverts
    Route::group(['prefix' => 'advert', 'middleware' => 'auth'], function(){
        Route::get('create', 'AdvertController@create')->name('advert.create');
        Route::post('create', 'AdvertController@store')->name('advert.store');
        Route::get('{advert}/delete', 'AdvertController@destroy')->name('advert.destroy')->middleware('can:delete,advert');
        Route::get('{advert}', 'AdvertController@show')->name('advert.show');
        Route::post('{advert}/message', 'AdvertController@message')->name('advert.message');
    });
    
});
