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
     Route::get('admin/home','Store\StoreController@home')->name('admin.home');
     Route::get('stores/create','Store\StoreController@create');
     Route::get('stores/{store_id}','Store\StoreController@show')->name('store.show');
     Route::delete('stores/{store_id}','Store\StoreController@destroy')->name('store.destroy');
     Route::get('stores' , 'Store\StoreController@index')->name('store.index');
     Route::post('stores' , 'Store\StoreController@store');
        });
    

});

Route::get('/home', 'HomeController@index')->name('home');
