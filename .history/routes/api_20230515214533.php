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

Route::get('/invoice/listing', [InvoiceController::class, 'listing']);
