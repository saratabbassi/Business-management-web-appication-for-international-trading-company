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
Route::resource('incoterm', 'incotermController');
Route::resource('sizes', 'SizesController');

Route::get('/productDetails/{id}', 'ProductsDetailsController@edit');

Route::get('download/{name}/{file_name}', 'ProductsDetailsController@get_file');

Route::get('view_file/{name}/{file_name}', 'ProductsDetailsController@open_file');

Route::post('delete_file', 'ProductsDetailsController@destroy')->name('delete_file');
Route::get('/edit_product/{id}', 'ProductsController@edit');
Route::get('/edit_customer/{id}', 'CustomersController@edit');
Route::get('/edit_invoice/{id}', 'InvoicesController@edit');
Route::get('/customers/{id}', 'InvoicesController@getcustomers');
Route::get('/getProducts/{id}', 'InvoicesController@getProducts');
Route::get('/getDesignation/{id}', 'InvoicesController@getDesignation');
Route::get('/Print_invoice_fr/{id}', 'InvoicesController@Print_invoice_fr');
Route::get('/Print_invoice_en/{id}', 'InvoicesController@Print_invoice_en');
Route::get('/Print_packing_fr/{id}', 'InvoicesController@Print_packing_fr');
Route::get('/Print_packing_en/{id}', 'InvoicesController@Print_packing_en');
Route::get('/Print_proforma_fr/{id}', 'InvoicesController@Print_proforma_fr');
Route::get('/Print_proforma_en/{id}', 'InvoicesController@Print_proforma_en');
Route::get('/InvoicesDetails/{id}', 'InvoicesDetailsController@edit');
Route::get('export_invoices', 'InvoicesController@export');
Route::post('/Status_Update/{id}', 'InvoicesController@Status_Update')->name('Status_Update');
Route::get('/Status_show/{id}', 'InvoicesController@show')->name('Status_show');
Route::get('/edit_profile', 'UserController@profile')->name('edit_profile');


Route::post('/edit_profile','UserController@update_avatar')->name('profile_update');

Route::get('export_products', 'ProductsController@export');
Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles','RoleController');
    Route::resource('users','UserController');
    });
    Route::get('Invoice_Paid','InvoicesController@Invoice_Paid');

    Route::get('Invoice_UnPaid','InvoicesController@Invoice_UnPaid');
    
    Route::get('Invoice_Partial','InvoicesController@Invoice_Partial');
    Route::resource('Archive', 'InvoiceArchiveController');
Route::delete('/{id}', 'ProductsController@delete');

Route::get('MarkAsRead_all','InvoicesController@MarkAsRead_all')->name('MarkAsRead_all');

Route::get('unreadNotifications_count', 'InvoicesController@unreadNotifications_count')->name('unreadNotifications_count');

Route::get('unreadNotifications', 'InvoicesController@unreadNotifications')->name('unreadNotifications');
Route::get('ReadNotification/{id}','InvoicesController@ReadNotification')->name('ReadNotification');







Route::get('/{page}', 'AdminController@index');


