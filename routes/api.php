<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::get('/projects', 'ProjectController@index');
// Route::post('/projects', 'ProjectController@store');
// Route::get('/projects/{id}', 'ProjectController@show');
// Route::put('/projects/{project}', 'ProjectController@markAsCompleted');
// Route::post('/tasks', 'TaskController@store');
// Route::put('/tasks/{task}', 'TaskController@markAsCompleted');




Route::get('/', 'PagesController@index');

Route::resource('brands', 'BrandsController');
Route::get('brands/{id}/delete', 'BrandsController@destroy');

// Route::get('brands', 'BrandsController@index');
// Route::get('brands/{id}', 'BrandsControllerController@show');
Route::resource('eventcategories', 'EventCategoriesController');
Route::get('eventcategories/{id}/delete', 'EventCategoriesController@destroy');
Route::resource('productcategories', 'ProductCategoriesController');
Route::get('productcategories/{id}/delete', 'ProductCategoriesController@destroy');
Route::resource('products', 'ProductController');
Route::get('products/{id}/delete', 'ProductController@destroy');
Route::resource('inventory', 'InventoryController');
Route::get('inventory/{id}/delete', 'InventoryController@destroy');
Route::resource('orders', 'OrderController');
Route::get('orders/{id}/delete', 'OrderController@destroy');
Route::resource('orderstatus', 'OrderStatusController');
Route::get('orderstatus/{id}/delete', 'OrderStatusController@destroy');
