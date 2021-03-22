<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CustomerController;
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

Route::redirect('/', '/admin');

Route::group(['prefix' => 'admin'], function() {
    Route::get('/', [ LoginController::class, 'login' ])->name('login');
    Route::post('/authenticate', [ LoginController::class, 'authenticate' ])->name('authenticate');
    Route::get('/forgot-password', [ LoginController::class, 'forgotPassword' ])->name('forgot.password');
    
    Route::group(['middleware' => ['auth']], function() {
        
        Route::get('/dashboard', [ AdminController::class, 'dashboard' ])->name('dashboard');
        /** Users routes */
        Route::get('/users', [ UserController::class, 'list' ])->name('users');
        Route::get('/users/delete/{id}', [ UserController::class, 'delete' ])->name('users.delete');
        Route::get('/users/add', [ UserController::class, 'addUser' ])->name('user.add');
        Route::post('/users', [ UserController::class, 'saveUser' ])->name('user.post');
        Route::get('/users/{id}/edit', [ UserController::class, 'edit' ])->name('user.edit');
        Route::put('/users/{id}', [ UserController::class, 'update' ])->name('user.update');

        Route::get('/customers', [ CustomerController::class, 'list' ])->name('customers');
        Route::get('/customers/delete/{id}', [ CustomerController::class, 'delete' ])->name('customers.delete');
        Route::get('/customers/add', [ CustomerController::class, 'addUser' ])->name('customer.add');
        Route::post('/customers', [ CustomerController::class, 'saveUser' ])->name('customer.post');
        Route::get('/customers/{id}/edit', [ CustomerController::class, 'edit' ])->name('customer.edit');
        Route::put('/customers/{id}', [ CustomerController::class, 'update' ])->name('customer.update');

        Route::get('/settings', [ AdminController::class, 'settings' ])->name('settings');

        
        Route::get('/edit/customer', 'UserController@editcustomer')->name('editcustomer');
        /** Service routes */
        Route::get('/services', 'ServiceController@show')->name('services.list')->middleware('cloudinary.init');
        Route::get('/services/edit/{id}', 'ServiceController@edit')->name('service.edit')->middleware('cloudinary.init');
        Route::get('/services/add', 'ServiceController@add')->name('service.add');
        Route::get('/services/delete/{id}', 'ServiceController@delete')->name('service.delete');
        Route::post('/services', 'ServiceController@addService')->name('service.post')->middleware('cloudinary.init');
        Route::put('/services/{id}', 'ServiceController@updateService')->name('service.update')->middleware('cloudinary.init');
        /** users routes */
        
        Route::get('/users/service-list/{id}', 'UserController@service')->name('user.service');
        Route::post('/users/{id}/document-update', 'UserController@updateDocuments')->name('user.document');
        /** Order routes */
        Route::get('/orders', 'OrderController@list')->name('orders.list');
        Route::get('/orders/edit/{id}', 'OrderController@edit')->name('order.edit');
        Route::put('/orders/{id}', 'OrderController@update')->name('order.update');
        Route::get('/orders/item-details/{id}', 'OrderController@orderDetails')->name('orders.order');
        Route::get('/order/delete/{id}', 'OrderController@delete')->name('order.delete');
        
        /** Accounts routes */
        Route::get('/accounts', 'OrderController@accounts')->name('order.accounts');
        /**export as excel */
        Route::get('/export/{type}', 'OrderController@export')->name('order.export');
        /** Home widget routes */
        Route::get('/widgets', 'HomeWidgetController@list')->name('widgets.list')->middleware('cloudinary.init');
        Route::get('/widgets/requests', 'HomeWidgetController@widget_requests')->name('widgets.requests');
        Route::get('/widgets/requests/delete/{id}', 'HomeWidgetController@widget_request_delete')->name('widgets.request.delete');
        Route::get('/widgets/add', 'HomeWidgetController@add')->name('widget.add');
        Route::get('/widgets/edit/{id}', 'HomeWidgetController@edit')->name('widget.edit')->middleware('cloudinary.init');
        Route::post('/widgets', 'HomeWidgetController@store')->name('widget.post')->middleware('cloudinary.init');
        Route::get('/widgets/delete/{id}', 'HomeWidgetController@delete')->name('widget.delete');
        Route::put('/widgets/{id}', 'HomeWidgetController@update')->name('widget.update')->middleware('cloudinary.init');
        /** Generate invoice */
        Route::get('/generate-invoice/{id}', 'InvoiceController@createInvoice')->name('save.invoice');
        Route::get('/unauthorized-access', 'UnauthorizedAccessController@index')->name('unauthorized');
        Route::get('/logout', 'LoginController@logout')->name('logout');
    });
    Route::get('/showvendors/{id}', 'api\v1\OrderController@sendNotificationsToAllVendors')->name('notifications');
});