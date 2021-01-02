<?php

use Illuminate\Support\Facades\Route;

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
//     return view('ProductListController@index');
// });
// Route::get('/product/{id}','ProductListController@show')->name('product.view');
// Route::get('/category/{name}','ProductListController@allProduct')->name('product.list');

Auth::routes();


Route::group(['middleware' => 'auth'], function () {

Route::get('/home', 'ProductController@index')->name('home');
Route::get('/','ProductController@index');

Route::resource('category','CategoryController');
Route::get('/category/download/{pdf}','CategoryController@download')->where('pdf', '.*');;

Route::resource('subcategory','SubcategoryController');

Route::resource('product','ProductController');
Route::get('subcategories/{id}','ProductController@loadSubcategories');

});
