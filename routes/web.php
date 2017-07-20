<?php

Route::get('/', 'HomeController@index');
Route::get('/cart', 'CartController@index');
Route::post('/email', 'CartController@email');
Route::get('/login', 'LoginController@index');
Route::post('/login', 'LoginController@login');
Route::get('/logout', 'LoginController@logout');
Route::get('/admin', 'AdminController@index')->middleware('admin');
Route::get('/products', 'ProductController@products')->middleware('admin');
Route::get('/products/edit/{id}', 'ProductController@edit')->middleware('admin');
Route::post('/save', 'ProductController@save')->middleware('admin');
Route::get('/products/delete/{id}', 'ProductController@delete')->middleware('admin');