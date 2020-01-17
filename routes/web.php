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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::middleware('auth')->group(function(){
    Route::middleware('admin-role')->group(function(){
        //routes related to admin Controller
        Route::group([],function(){
            Route::get('admin/home','Admin\AdminController@home')->name('admin.home');
                 
        });
        //routest for store controller
        Route::group([],function(){
                 Route::get('stores/create','Store\StoreController@create');
                 Route::get('stores/{store_id}','Store\StoreController@show')->name('store.show');
                 Route::delete('stores/{store_id}','Store\StoreController@destroy')->name('store.destroy');
                 Route::get('stores' , 'Store\StoreController@index')->name('store.index');
                 Route::post('stores' , 'Store\StoreController@store');
                    });
        });
        //routes for Category Controller
        Route::group([],function(){
                Route::get('categories/create','Category\CategoryController@create')->name('category.create');
                Route::post('categories','Category\CategoryController@store')->name('category.store');
        });
        //routes for brand Controlelr
        Route::group([],function(){
                Route::get('brands/create','Brand\BrandController@create');
                Route::post('brands','Brand\BrandController@store');
                Route::get('brands','Brand\BrandController@index')->name('brand.index');
                Route::delete('brands/{brand_id}','Brand\BrandController@destroy')->name('brand.destroy');
                Route::get('brands/{brand_id}','Brand\BrandController@show')->name('brand.show');
        });

});

Route::get('/home', 'HomeController@index')->name('home');
