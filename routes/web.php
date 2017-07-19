<?php

Route::get('/', 'HomeController@index');
Route::get('/cart', 'CartController@index');
Route::post('/email', 'CartController@email');
Route::get('/login', 'LoginController@index');
Route::post('/login', 'LoginController@login');
Route::get('/logout', 'LoginController@logout');
Route::get('/admin', 'AdminController@index')->middleware('admin');
Route::get('/products', 'AdminController@products')->middleware('admin');
Route::get('/products/create', 'AdminController@create')->middleware('admin');
Route::get('/products/{id}/edit', 'AdminController@edit')->middleware('admin');
Route::post('/create', 'ProductController@create')->middleware('admin');
Route::post('/update', 'ProductController@update')->middleware('admin');
Route::get('/products/{id}/delete', 'ProductController@delete')->middleware('admin');