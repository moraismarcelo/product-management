<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\ProductBrandController;
use App\Http\Controllers\Api\ProductVoltageController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('/products')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('api.products.index');
    Route::post('/', [ProductController::class, 'store'])->name('api.products.store');
    Route::put('/{id}', [ProductController::class, 'update'])->name('api.products.update');
    Route::delete('/{id}', [ProductController::class, 'destroy'])->name('api.products.destroy');
});

Route::prefix('/product-brands')->group(function () {
    Route::get('/', [ProductBrandController::class, 'index'])->name('api.product-brands.index');
});

Route::prefix('/product-voltages')->group(function () {
    Route::get('/', [ProductVoltageController::class, 'index'])->name('api.product-voltages.index');
});
