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

Route::get('/', function () {
    return view('auth.login');
});




//Auth::routes(['register' => false]);
Auth::routes();



Route::get('/home', 'HomeController@index')->name('home');


Route::resource('products', 'ProductsController');
Route::resource('customers', 'customersController'); // /customers/{id}
Route::resource('invoices', 'InvoicesController');

Route::resource('ProductAttachments', 'ProductsAttachementController');
Route::resource('categories', 'CategoriesController');
Route::resource('devise', 'deviseController');
Route::resource('sizes', 'SizesController');

Route::get('/productDetails/{id}', 'ProductsDetailsController@edit');

Route::get('download/{name}/{file_name}', 'ProductsDetailsController@get_file');

Route::get('view_file/{name}/{file_name}', 'ProductsDetailsController@open_file');

Route::post('delete_file', 'ProductsDetailsController@destroy')->name('delete_file');
Route::get('/edit_product/{id}', 'ProductsController@edit');
Route::get('/edit_customer/{id}', 'CustomersController@edit');
Route::get('/customers/{id}', 'InvoicesController@getcustomers');
Route::get('/getProducts/{id}', 'InvoicesController@getProducts');
Route::get('/getDesignation/{id}', 'InvoicesController@getDesignation');
Route::delete('/{id}', 'ProductsController@delete');




Route::get('/{page}', 'AdminController@index');


