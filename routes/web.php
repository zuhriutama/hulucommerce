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

Auth::routes();

Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('products', 'ProductController@index')->name('product-list');
Route::get('product/{slug}', 'ProductController@detail')->name('product-detail');
Route::get('city', 'AddressController@getCity')->name('get-city-of-province');
Route::get('thankyou', 'CheckoutController@thankyou')->name('thankyou');

// for user only
Route::middleware('auth')->group(function () {
	Route::get('cart/add/{slug}', 'CartController@addProduct')->name('add-to-cart');
	Route::get('cart/remove/{id}', 'CartController@removeProduct')->name('remove-from-cart');
    Route::get('cart/buy/{slug}', 'CartController@buyProduct')->name('buy-product');
	Route::get('cart', 'CartController@index')->name('cart');
    Route::get('checkout', 'CheckoutController@index')->name('checkout');
    Route::get('checkout/shipping', 'CheckoutController@shipping')->name('checkout-shipping');
    Route::get('checkout/payment', 'CheckoutController@payment')->name('checkout-payment');
    Route::get('checkout/finish', 'CheckoutController@finish')->name('checkout-finish');
    Route::post('add-address', 'AddressController@add')->name('add-address');
    Route::post('set-address', 'CheckoutController@setAddress')->name('set-address-for-order');
    Route::get('user/profile', 'UserController@profile')->name('profile');
    Route::post('user/profile', 'UserController@update')->name('update-profile');
});

Route::prefix('admin')->namespace('Admin')->middleware('auth')->group(function () {
    Route::get('/', 'AdminController@index');
    Route::get('home', 'AdminController@index')->name('dashboard');
    Route::resource('products', 'ProductController');
    Route::resource('users', 'UserController');
    Route::resource('user-addresses', 'UserAddressController');
    Route::resource('payment-methods', 'PaymentMethodController');
    Route::resource('shipping-methods', 'ShippingMethodController');
    Route::resource('provinces', 'ProvinceController');
    Route::resource('cities', 'CityController');
    Route::resource('orders', 'OrderController');

    Route::post('product/remove-image/{id}', 'ProductController@removeImage')->name('remove-image-product');

});