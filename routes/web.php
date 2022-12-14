<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\OperatorController;
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
        Route::post('/users', [ UserController::class, 'create' ])->name('user.post');
        Route::get('/users/{id}/edit', [ UserController::class, 'edit' ])->name('user.edit');
        Route::put('/users/{id}', [ UserController::class, 'update' ])->name('user.update');
        Route::get('/users/{id}/delete', [ UserController::class, 'delete' ])->name('user.delete');
        /** Customers routes */
        Route::get('/customers', [ CustomerController::class, 'list' ])->name('customers');
        Route::get('/customers/delete/{id}', [ CustomerController::class, 'delete' ])->name('customers.delete');
        Route::get('/customers/add', [ CustomerController::class, 'addCustomer' ])->name('customer.add');
        Route::get('/customers/import', [ CustomerController::class, 'importCustomers' ])->name('customer.import');
        Route::post('/customers/import-process', [ CustomerController::class, 'processImport' ])->name('customer.process.import');
        Route::post('/customers', [ CustomerController::class, 'create' ])->name('customer.post');
        Route::get('/customers/{id}/edit', [ CustomerController::class, 'edit' ])->name('customer.edit');
        Route::put('/customers/{id}', [ CustomerController::class, 'update' ])->name('customers.update');
        Route::get('/customers/{id}/delete', [ CustomerController::class, 'delete' ])->name('customer.delete');
    
        /** Operators routes */
        Route::get('/operators', [ OperatorController::class, 'list' ])->name('operators');
        Route::get('/operators/delete/{id}', [ OperatorController::class, 'delete' ])->name('operators.delete');
        Route::get('/operators/add', [ OperatorController::class, 'addCustomer' ])->name('operator.add');
        Route::post('/operators', [ OperatorController::class, 'create' ])->name('operator.store');
        Route::get('/operators/{id}/edit', [ OperatorController::class, 'edit' ])->name('operator.edit');
        Route::put('/operators/{id}', [ OperatorController::class, 'update' ])->name('operator.update');
        Route::get('/operators/{id}/delete', [ OperatorController::class, 'delete' ])->name('operator.delete');
        Route::get('/download-file', [ OperatorController::class, 'downloadFile' ])->name('download-file');

        Route::get('/settings', [ AdminController::class, 'settings' ])->name('settings');
        Route::put('/settings', [ AdminController::class, 'updateSettings' ])->name('settings.update');

        
        Route::get('/edit/customer', 'UserController@editcustomer')->name('editcustomer');
        
        /** Service routes */
        Route::get('/services', [ ServiceController::class, 'list' ])->name('services');
        Route::get('/services/edit/{id}', [ ServiceController::class, 'edit' ])->name('services.edit');
        Route::get('/services/add', [ ServiceController::class, 'create' ])->name('services.create');
        Route::get('/services/delete/{id}', 'ServiceController@delete')->name('service.delete');
        Route::post('/services', [ServiceController::class, 'store'])->name('services.store');
        Route::get('/services/{id}', [ServiceController::class, 'destroy'])->name('services.destroy');
        Route::put('/services/{id}', [ServiceController::class, 'update'])->name('services.update');
        
        # Invoices
        Route::get('/invoices', [ InvoiceController::class, 'list' ])->name('invoices');
        Route::get('/invoices/delete/{id}', [ InvoiceController::class, 'delete' ])->name('invoices.delete');
        Route::get('/invoices/add', [ InvoiceController::class, 'create' ])->name('invoices.add');
        Route::post('/invoices', [ InvoiceController::class, 'store' ])->name('invoice.store');
        Route::get('/invoices/{id}/edit', [ InvoiceController::class, 'edit' ])->name('invoices.edit');
        Route::put('/invoices/{id}', [ InvoiceController::class, 'update' ])->name('invoices.update');
        Route::get('/connection-dates', [ InvoiceController::class, 'getConnectionStartEndDates' ])->name('invoice.connection.dates');
        Route::get('/generate-invoice/{id}', [ InvoiceController::class, 'generateInvoice' ])->name('invoice.generate');
        Route::get('/generate-invoices', [ InvoiceController::class, 'generateBulkInvoices' ])->name('invoices.bulk.generate');
        Route::get('/invoices/{id}/payment-meta', [ InvoiceController::class, 'getInvoicePaymentMeta' ])->name('invoices.payment.status');
        Route::put('/invoices/{id}/payment-meta', [ InvoiceController::class, 'updateInvoicePaymentMeta' ])->name('invoices.payment.updates');

        /** Generate invoice */
        Route::get('/unauthorized-access', 'UnauthorizedAccessController@index')->name('unauthorized');
        Route::get('/logout', [ LoginController::class, 'logout'])->name('logout');
    });
    Route::get('/showvendors/{id}', 'api\v1\OrderController@sendNotificationsToAllVendors')->name('notifications');
});