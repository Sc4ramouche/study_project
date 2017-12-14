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

Route::get('/', 'IndexController@home');
Route::get('/about', 'IndexController@about');
Route::get('/catalog', 'IndexController@catalog');
Route::get('/card-product', 'IndexController@card_product');
Route::get('/news', 'IndexController@news');
Route::get('/delivery', 'IndexController@delivery');
Route::get('/contacts', 'IndexController@contacts');
Route::get('/account', 'IndexController@account');

//Kirill adds
Route::get('/adminpanel', 'AdminController@general');
