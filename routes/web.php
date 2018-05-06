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


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'HomeController@index')->name('home');
Route::get('logout', 'Auth\LoginController@logout');
//User

Route::get('/user/admin', 'UserController@index');
Route::get('/user/show/{id}', 'UserController@show');
Route::get('/user/edit/{id}', 'UserController@edit');
Route::post('/user/edit/{id}', 'UserController@update');
Route::get('/user/delete/{id}/{active}', 'UserController@destroy');
Route::get('/user/create', 'UserController@create');
Route::post('/user/create', 'UserController@store');

//Offer

Route::get('/offers/admin', 'OffersController@index');
Route::get('/offers/show/{id}', 'OffersController@show');
Route::get('/offers/edit/{id}', 'OffersController@edit');
Route::post('/offers/edit/{id}', 'OffersController@update');
Route::get('/offers/delete/{id}/{active}', 'OffersController@destroy');
Route::get('/offers/create', 'OffersController@create');
Route::post('/offers/create', 'OffersController@store');

//Category

Route::get('/category/admin', 'CategoryController@index');
Route::get('/category/show/{id}', 'CategoryController@show');
Route::get('/category/edit/{id}', 'CategoryController@edit');
Route::post('/category/edit/{id}', 'CategoryController@update');
Route::get('/category/delete/{id}/{active}', 'CategoryController@destroy');
Route::get('/category/create', 'CategoryController@create');
Route::post('/category/create', 'CategoryController@store');


//items

Route::get('/items/admin', 'ItemsController@index');
Route::get('/items/show/{id}', 'ItemsController@show');
Route::get('/items/edit/{id}', 'ItemsController@edit');
Route::post('/items/edit/{id}', 'ItemsController@update');
Route::get('/items/delete/{id}/{active}', 'ItemsController@destroy');
Route::get('/items/create', 'ItemsController@create');
Route::post('/items/create', 'ItemsController@store');

//extra

Route::get('/extra/admin', 'ExtraController@index');
Route::get('/extra/show/{id}', 'ExtraController@show');
Route::get('/extra/edit/{id}', 'ExtraController@edit');
Route::post('/extra/edit/{id}', 'ExtraController@update');
Route::get('/extra/delete/{id}/{active}', 'ExtraController@destroy');
Route::get('/extra/create', 'ExtraController@create');
Route::post('/extra/create', 'ExtraController@store');


//subitem

Route::get('/subitems/edit/{id}', 'SubItemController@edit');
Route::post('/subitems/edit/{id}', 'SubItemController@update');
Route::get('/subitems/delete/{item_id}/{extra_id}', 'SubItemController@destroy');
Route::get('/subitems/create/{id}', 'SubItemController@create');
Route::post('/subitems/create', 'SubItemController@store');




//description

Route::get('/desc/admin', 'DescriptionController@index');
Route::get('/desc/show/{id}', 'DescriptionController@show');
Route::get('/desc/edit/{id}', 'DescriptionController@edit');
Route::post('/desc/edit/{id}', 'DescriptionController@update');
Route::get('/desc/delete/{id}/{active}', 'DescriptionController@destroy');
Route::get('/desc/create', 'DescriptionController@create');
Route::post('/desc/create', 'DescriptionController@store');


//description item

Route::get('/desitem/edit/{id}', 'ItemDescController@edit');
Route::post('/desitem/edit/{id}', 'ItemDescController@update');
Route::get('/desitem/delete/{item_id}/{desc_id}', 'ItemDescController@destroy');
Route::get('/desitem/create/{id}', 'ItemDescController@create');
Route::post('/desitem/create', 'ItemDescController@store');

//compo

Route::get('/compo/admin', 'CompoOffersController@index');
Route::get('/compo/show/{id}', 'CompoOffersController@show');
Route::get('/compo/edit/{id}', 'CompoOffersController@edit');
Route::post('/compo/edit/{id}', 'CompoOffersController@update');
Route::get('/compo/delete/{id}/{active}', 'CompoOffersController@destroy');
Route::get('/compo/create', 'CompoOffersController@create');
Route::post('/compo/create', 'CompoOffersController@store');


//compo item

Route::get('/compoitem/edit/{id}', 'ItemsOfferController@edit');
Route::post('/compoitem/edit/{id}', 'ItemsOfferController@update');
Route::get('/compoitem/delete/{item_id}/{offer_id}', 'ItemsOfferController@destroy');
Route::get('/compoitem/create/{id}', 'ItemsOfferController@create');
Route::post('/compoitem/create', 'ItemsOfferController@store');



//offer extra items

Route::get('/extraoffer/edit/{id}', 'ExtraOffersController@edit');
Route::post('/extraoffer/edit/{id}', 'ExtraOffersController@update');
Route::get('/extraoffer/delete/{extra_id}/{offer_id}', 'ExtraOffersController@destroy');
Route::get('/extraoffer/create/{id}', 'ExtraOffersController@create');
Route::post('/extraoffer/create', 'ExtraOffersController@store');



//offer extra items

Route::get('/cateExtra/edit/{id}', 'CategoryExtrasController@edit');
Route::post('/cateExtra/edit/{id}', 'CategoryExtrasController@update');
Route::get('/cateExtra/delete/{cate_id}/{extra_id}', 'CategoryExtrasController@destroy');
Route::get('/cateExtra/create/{id}', 'CategoryExtrasController@create');
Route::post('/cateExtra/create', 'CategoryExtrasController@store');
