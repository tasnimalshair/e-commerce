<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Cart\CartController;
use App\Http\Controllers\CartItem\CartItemController;
use App\Http\Controllers\Category\CategoryController;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\Variant\VariantController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

# Auth
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->post('logout', [AuthController::class, 'logout']);

# Categories
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('categories', [CategoryController::class, 'index']);
    Route::get('categories/{category}', [CategoryController::class, 'show']);
});

Route::middleware(['auth:sanctum', 'role:admin'])->group(function () {
    Route::post('categories', [CategoryController::class, 'store']);
    Route::put('categories/{category}', [CategoryController::class, 'update']);
    Route::delete('categories/{category}', [CategoryController::class, 'destroy']);
});

# Products
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('products', [ProductController::class, 'index']);
    Route::get('products/{product}', [ProductController::class, 'show']);
});

Route::middleware(['auth:sanctum', 'role:admin|seller'])->group(function () {
    Route::post('products', [ProductController::class, 'store']);
    Route::put('products/{product}', [ProductController::class, 'update']);
    Route::delete('products/{product}', [ProductController::class, 'destroy']);
});


# Variants
Route::middleware(['auth:sanctum'])->group(function () {
    Route::resource('variants', VariantController::class)->only(['index', 'show']);
});

Route::middleware(['auth:sanctum', 'role:admin|seller'])->group(function () {
    Route::resource('variants', VariantController::class)->except(['index', 'show']);
});


Route::post('carts', [CartController::class, 'store']);
# Carts
Route::middleware(['auth:sanctum', 'role:admin|buyer'])->group(function () {
    // Route::resource('carts', CartController::class);
    Route::get('carts/{cart}', [CartController::class, 'show']);
    Route::post('carts/{cart}', [CartController::class, 'destroy']);
});

# CartItems
Route::middleware(['auth:sanctum', 'role:admin|buyer'])->group(function () {
    Route::resource('cartItems', CartItemController::class);
    Route::delete('cartItems', [CartItemController::class, 'clear']);
});

// الراوتس بين اليوزر والزائر
