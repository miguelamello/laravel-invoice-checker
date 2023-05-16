<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//use App\Infrastructure\Providers\AppServiceProvider;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\CompanyController;

Route::get('/invoice/list', [InvoiceController::class, 'list']);
Route::get('/invoice/{id}', [InvoiceController::class, 'getInvoice']);

Route::get('/company/list', [CompanyController::class, 'list']);
Route::get('/company/{id}', [CompanyController::class, 'getCompany']);

Route::get('/product/list', [ProductController::class, 'list']);
Route::get('/Product/{id}', [ProductController::class, 'getProduct']);

// Fallback route for undefined routes
Route::fallback(function () {
  return response()->json(['error' => 'Route not found'], 404);
});