<?php

Route::get('/', 'HomeController@index');
Route::get('/cart', 'CartController@index');
Route::get('/login', 'LoginController@index');
Route::post('/login', 'LoginController@login');
Route::get('/logout', 'LoginController@logout');
Route::get('/admin', 'AdminController@index');
Route::get('/products', 'AdminController@products');
Route::get('/products/create', 'AdminController@create');
Route::post('/new_product', 'AdminController@new_product');
Route::post('/patch_product', 'AdminController@patch_product');
Route::get('/products/{id}/edit', 'AdminController@edit');