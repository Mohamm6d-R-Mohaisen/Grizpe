<?php

use App\Http\Controllers\Api\V1\HomeController;
use App\Http\Controllers\Api\V1\Auth\AuthController;
use App\Http\Controllers\Api\V1\CartController;
use App\Http\Controllers\Api\V1\OrderController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'api/v1', 'as' => 'api.v1.'], function () {
    Route::post('customer/register', [AuthController::class, 'register']);
    Route::post('customer/login', [AuthController::class, 'login']);
    Route::get('home', [HomeController::class, 'getHomePage']);
    Route::get('products/{id}', [HomeController::class, 'getProduct']);
    Route::get('offers', [HomeController::class, 'getOffers']);
    Route::get('products', [HomeController::class, 'getProductsOfCategory']);
    Route::get('descendant-categories', [HomeController::class, 'getCategories']);

    /* ------------------------------------- Users API's --------------------------------- */
    Route::group(['middleware' => ['auth:user_api']], function(){
        Route::group(['prefix' => 'user', 'as' => 'user.'], function () {
            Route::post('logout', [AuthController::class, 'logout']);
        });

        Route::get('checkout/cart', [CartController::class, 'getCartDetails']);
        Route::post('checkout/cart/add/{product_id}', [CartController::class, 'addProductToCart']);
        Route::get('checkout/cart/remove-item/{product_id}', [CartController::class, 'removePrductFromCart']);
        Route::post('checkout/save-order', [OrderController::class, 'checkout']);
    });
    /* ------------------------------------- End Users API's --------------------------------- */


});
Route::get('/payment/success', [OrderController::class, 'paymentSuccess'])->name('payment.success');
Route::get('/payment/cancel', [OrderController::class, 'paymentCancel'])->name('payment.cancel');