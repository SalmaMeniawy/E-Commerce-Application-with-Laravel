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
    //routes for buyer
    Route::middleware('buyer-role')->group(function(){

        Route::group([],function(){
            Route::get('shCart/{product_id}','ShoppingCart\ShoppingCartController@add_to_shopping_cart')->name('addShopCart');
            Route::delete('shoppingCart/{id}','ShoppingCart\ShoppingCartController@destroy')->name('shoppingcart.destroy');
        });
        Route::get('homepage','Buyer\BuyerController@index')->name('buyer.index');
        Route::get('product/{product_id}','Buyer\BuyerController@get_product_details')->name('buyer.product.show');
        Route::get('buyer/logout','Buyer\BuyerController@logout')->name('buyer.logout');
        Route::get('shoppingCart','Buyer\BuyerController@get_shopping_cart_details')->name('buyer.shoppingCart');
      
    });
    //routes for seller
    Route::middleware('seller-role')->group(function(){
  
        Route::get('products/create','Product\ProductController@create')->name('product.create');
        Route::post('products','Product\ProductController@store');
        Route::get('products','Product\ProductController@index')->name('product.index');
        Route::get('products/{product_id}','Product\ProductController@show')->name('product.show');
        Route::delete('products/{product_id}','Product\ProductController@destroy')->name('product.destroy');
        Route::get('home/seller','Seller\SellerController@create')->name('seller.home');
        Route::get('seller/logout','Seller\SellerController@logout')->name('seller.logout');
    });
    //routes for admin
    Route::middleware('admin-role')->group(function(){
        //routes related to admin Controller
        Route::group([],function(){
            Route::get('admin/home','Admin\AdminController@home')->name('admin.home');
            Route::get('admin/logout','Admin\AdminController@logout')->name('admin.logout');
                 
        });
        //routest for store controller
        Route::group([],function(){
                 Route::get('stores/create','Store\StoreController@create');
                 Route::get('sellers','Store\StoreController@get_all_sellers');
                 Route::get('stores/{store_id}','Store\StoreController@show')->name('store.show');
                 Route::delete('stores/{store_id}','Store\StoreController@destroy')->name('store.destroy');
                 Route::get('stores' , 'Store\StoreController@index')->name('store.index');
                 Route::post('stores' , 'Store\StoreController@store');
                    });
        });
        //routes for Coupon Controller
        Route::group([],function(){
            Route::get('coupons/create' , 'Coupon\CouponController@create')->name('coupon.create');
            Route::post('coupons','Coupon\CouponController@store')->name('coupon.store');
            Route::get('coupons','Coupon\CouponController@index')->name('coupon.index');
            Route::get('coupons/{coupon_id}','Coupon\CouponController@show')->name('coupon.show');
            Route::delete('coupons/{coupon_id}','Coupon\CouponController@destroy')->name('coupon.destroy');
        });
        //routes for Category Controller
        Route::group([],function(){
                Route::get('categories/create','Category\CategoryController@create')->name('category.create');
                Route::post('categories','Category\CategoryController@store')->name('category.store');

                Route::get('categories','Category\CategoryController@index')->name('category.index');
                Route::get('categories/{category_id}','Category\CategoryController@show')->name('category.show');
                Route::delete('categories/{category_id}','Category\CategoryController@destroy')->name('category.destroy');
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
