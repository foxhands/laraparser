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
Route::prefix('intel')->group(function() {
    Route::get('/category/update', 'IntelCategoriesController@update');
    Route::get('/category/create', 'IntelCategoriesController@create');
    Route::get('/product/update', 'IntelProcessorsController@update');
    Route::get('/product/create', 'IntelProcessorsController@create');
    Route::get('/element/update', 'IntelElementController@update');
    Route::get('/element/create', 'IntelElementController@create');
    Route::get('/tech/element/update', 'TechElementController@update');
    Route::get('/tech/element/create', 'TechElementController@create');
});
