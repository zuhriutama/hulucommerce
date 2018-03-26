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

Route::get('/', 'HomeController@index')->name('home');
Route::get('products', 'ProductController@index')->name('product-list');
Route::get('product/{slug}', 'ProductController@detail')->name('product-detail');

Route::prefix('admin')->namespace('Admin')->middleware('auth')->group(function () {

    Route::get('/', 'AdminController@index');
    Route::get('home', 'AdminController@index');
    Route::resource('products', 'ProductController');

});