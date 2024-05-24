<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiAuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Blade\ApiUserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/


# Api Clients
Route::post('/login',[ApiAuthController::class,'login']);

Route::group(['middleware' => 'api-auth'],function (){
    Route::post('/me',[ApiAuthController::class,'me']);
    Route::post('/tokens',[ApiAuthController::class,'getAllTokens']);
    Route::post('/logout',[ApiAuthController::class,'logout']);
});

Route::group(['middleware' => 'ajax.check'],function (){
    Route::post('/api-user/toggle-status/{user_id}',[ApiUserController::class,'toggleUserActivation']);
    Route::post('/api-token/toggle-status/{token_id}',[ApiUserController::class,'toggleTokenActivation']);
});

# Api Products
Route::get('/get/products',[ProductController::class, 'allProduct'])->name('productAll');
Route::get('/get/product/{id}',[ProductController::class, 'showProduct'])->name('productShow');
Route::post('/product/update/{id}',[ProductController::class, 'updateProduct'])->name('productUpdate');
Route::delete('/product/delete/{id}',[ProductController::class, 'deleteProduct'])->name('productDelete');

# Api Category
Route::get('/get/categories',[CategoryController::class, 'allCategory'])->name('categoryAll');
Route::get('/get/category/{id}',[CategoryController::class, 'showCategory'])->name('categoryShow');
Route::post('/category/update/{id}',[CategoryController::class, 'updateCategory'])->name('categoryUpdate');
Route::delete('/category/delete/{id}',[CategoryController::class, 'deleteCategory'])->name('categoryDelete');


// Route::post('/get/orders',[OrderController::class, 'getOrders'])->name('orderAll');
// Route::delete('/order/delete/{id}',[OrderController::class, 'deleteOrder'])->name('orderDelete');
// Route::post('/order/complete/{id}',[OrderController::class, 'completeOrder'])->name('orderComplate');
// Route::post('/order/update/{id}',[OrderController::class, 'updateOrderStatus'])->name('orderUpdate');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
