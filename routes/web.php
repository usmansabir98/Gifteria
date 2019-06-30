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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::view('/{path?}', 'app');



// Route::get('/', 'PagesController@index');
//  Route::resource('brands', 'BrandsController');
//  Route::resource('eventcategories', 'EventCategoriesController');
//  Route::resource('productcategories', 'ProductCategoriesController');
//  Route::resource('products', 'ProductController');
//  Route::resource('inventory', 'InventoryController');
//  Route::resource('orders', 'OrderController');
//  Route::resource('orderstatus', 'OrderStatusController');
