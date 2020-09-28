<?php

use Illuminate\Support\Facades\Route;

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

Route::group(['middleware' => 'auth'],function(){
    Route::get('/logout','Auth\LoginController@logout');

    Route::group(['middleware' => 'admin', 'prefix' => 'admin'], function(){
        Route::get('/create', 'AdminController@create');
        Route::post('/create', 'AdminController@store');
        Route::get('/items', 'AdminController@items');
        Route::get('/users', 'AdminController@users');
        Route::get('/sales', 'AdminController@sales');
        Route::get('/detail-order/{id}', 'AdminController@detail');
        Route::get('/edit/{id}', 'AdminController@edit');
        Route::patch('/update/{id}', 'AdminController@update');
        Route::delete('/delete/{id}', 'AdminController@destroy');
        Route::get('/category', 'CategoryController@index');
        Route::post('/category', 'CategoryController@store');
    });
    
    Route::group(['middleware' => 'member'], function(){
        Route::get('/view/{id}', 'ShopController@show');
        Route::resource('cart', 'ShopController');
        Route::post('/checkout', 'ShopController@checkout');
        Route::get('/transaction', 'ShopController@transaction');
        Route::get('/detail/{id}', 'ShopController@detail');
    });

});