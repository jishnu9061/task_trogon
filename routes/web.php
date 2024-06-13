<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DiscountCalculateController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


// Task 1
Route::get('/', [HomeController::class, 'showProducts']);

// Task 2
Route::get('/discount', [DiscountCalculateController::class, 'discountView']);
Route::get('/calculate-discount', [DiscountCalculateController::class, 'calculateDiscount']);

// Task 3
Route::get('/filter-product', [ProductController::class, 'filterProduct']);
Route::get('/sum-product', [ProductController::class, 'sumOfProduct']);
Route::get('/sort-product', [ProductController::class, 'sortProduct']);

// Task 4
Route::get('/show-product-value', [ProductController::class, 'showTotalStockValue']);
Route::get('/show-product-value-optimized', [ProductController::class, 'showTotalStockValueOptimized']);

// Task 5
Route::get('/get-order', [OrderController::class, 'getOrderSummary']);


