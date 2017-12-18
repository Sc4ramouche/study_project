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
Route::get('/productcard', 'IndexController@productcard');
Route::get('/catalog', 'CatalogController@catalog');
Route::get('/news', 'IndexController@news');
Route::get('/delivery', 'IndexController@delivery');
Route::get('/contacts', 'IndexController@contacts');
Route::get('/account', 'IndexController@account');//Если не залогинено кидает на /account/login
Route::get('/cart', 'IndexController@cart');

//Auth::routes();

//User Auth
Route::get('/account/login', 'Auth\LoginController@showLoginForm');
Route::post('/account/login', 'Auth\LoginController@login');
Route::get('/account/logout', 'Auth\LoginController@logout');
Route::get('/account/register', 'Auth\RegisterController@showRegistrationForm');
Route::post('/account/register', 'Auth\RegisterController@register');

//Admin Auth
Route::get('/admin','AdminController@adminpanel'); //Если не залогинено кидает на /admin/login
Route::get('/admin/login', 'AuthAdmin\LoginController@showLoginForm');
Route::post('/admin/login', 'AuthAdmin\LoginController@login');
Route::get('/admin/logout', 'AuthAdmin\LoginController@logout');

//Роуты для контроллера панели администратора
//Для категорий
Route::GET('/admin/GetCategory', 'AdminController@GetCategory');
Route::POST('/admin/AddCategory', 'AdminController@AddCategory');

//Для подкатегорий
Route::GET('/admin/GetSubCategory', 'AdminController@GetSubCategory');
Route::POST('/admin/AddSubCategory', 'AdminController@AddSubCategory');

//Для характеристик подкатегорий
Route::GET('/admin/GetSubCatChar', 'AdminController@GetSubCatChar');
Route::POST('/admin/AddSubCatChar', 'AdminController@AddSubCatChar');

//Для названий характеристик
Route::GET('/admin/GetCharacteristic', 'AdminController@GetCharacteristic');