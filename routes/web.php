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
Route::get('/news', 'IndexController@news');
Route::get('/delivery', 'IndexController@delivery');
Route::get('/contacts', 'IndexController@contacts');
Route::get('/account', 'IndexController@account');//Если не залогинено кидает на /account/login
Route::get('/checkout', 'IndexController@checkout');
Route::get('/cart', 'IndexController@cart');

//Catalog Routs
Route::get('/catalog', 'CatalogController@catalog');
Route::get('/catalog/{category}', 'CatalogController@catalog_category');
Route::get('/catalog/{category}/{subcategory}', 'CatalogController@catalog_subcategory');
Route::POST('/catalog/filter', 'CatalogController@ajax_filter');
Route::get('/sss', 'CatalogController@test');


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
Route::PUT('/admin/RedactSubCatChar', 'AdminController@RedactSubCatChar');
Route::DELETE('/admin/DeleteSubCatChar', 'AdminController@DeleteSubCatChar');

//Для названий характеристик
Route::GET('/admin/GetCharacteristic', 'AdminController@GetCharacteristic');

//Для Брендов
Route::GET('/admin/GetBrend', 'AdminController@GetBrend');
Route::POST('/admin/AddBrend', 'AdminController@AddBrend');
Route::DELETE('/admin/DeleteBrend', 'AdminController@DeleteBrend');
Route::PUT('/admin/UpdateBrend', 'AdminController@UpdateBrend');

//Для Материалов
Route::GET('/admin/GetMaterial', 'AdminController@GetMaterial');
Route::POST('/admin/AddMaterial', 'AdminController@AddMaterial');
Route::DELETE('/admin/DeleteMaterial', 'AdminController@DeleteMaterial');
Route::PUT('/admin/UpdateMaterial', 'AdminController@UpdateMaterial');

//Для Стран
Route::GET('/admin/GetCountry', 'AdminController@GetCountry');
Route::POST('/admin/AddCountry', 'AdminController@AddCountry');
Route::DELETE('/admin/DeleteCountry', 'AdminController@DeleteCountry');
Route::PUT('/admin/UpdateCountry', 'AdminController@UpdateCountry');

//Для моделей
Route::GET('/admin/GetModel', 'AdminController@GetModel');
Route::POST('/admin/AddModel', 'AdminController@AddModel');
Route::DELETE('/admin/DeleteModel', 'AdminController@DeleteModel');
Route::PUT('/admin/UpdateModel', 'AdminController@UpdateModel');


