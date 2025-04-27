<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\AttributeValueController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\HomeSectionController;
use App\Http\Controllers\Admin\OfferController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PaymentGatewayController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\ShippingCompanyController;
use App\Http\Controllers\Admin\StaticPageController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\QuestionController;
use App\Http\Controllers\Admin\GalaryController;
use App\Http\Controllers\Admin\AddController;
use \App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\PlaneController;
use App\Http\Controllers\Admin\WorkController;
use App\Http\Controllers\Admin\BlogeControll;
use App\Http\Controllers\Admin\CommentControll;
use App\Http\Controllers\Admin\ContactController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]], function(){
    /* ------------------------------------- Auth Routes --------------------------------- */
    Route::get('admin/login', [LoginController::class, 'showLoginForm'])->name('admin.login');
    Route::post('admin/login', [LoginController::class, 'login'])->name('admin.login.post');
    Route::post('admin/logout', [LoginController::class, 'logout'])->name('admin.logout');
    /* ------------------------------------- Admin Dashboard --------------------------------- */
    Route::group(['middleware' => ['auth:admin', 'admin'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
        Route::get('/', [HomeController::class, 'index'])->name('home');

        /* ------------------------------------- Category Routes --------------------------------- */
        Route::resource('categories', CategoryController::class);
        Route::group(['prefix' => 'categories', 'as' => 'categories.'], function () {
            Route::get('data/datatables', [CategoryController::class , 'datatable'])->name('datatable');
            Route::post('activate/{id}', [CategoryController::class, 'activate'])->name('active');
        });
        /* ------------------------------------- Category Routes --------------------------------- */

        /* ------------------------------------- Admin Routes --------------------------------- */
        Route::resource('admins', AdminController::class);
        Route::group(['prefix' => 'admins', 'as' => 'admins.'], function () {
            Route::get('data/datatables', [AdminController::class, 'datatable'])->name('datatable');
            Route::post('activate/{id}', [AdminController::class, 'activate'])->name('active');
            Route::post('bluck/delete', [AdminController::class , 'bluckDestroy'])->name('bluck_delete');
        });
        /* ------------------------------------- Admin Routes --------------------------------- */

        /* ------------------------------------- User Routes --------------------------------- */
        Route::resource('users', UserController::class);
        Route::group(['prefix' => 'users', 'as' => 'users.'], function () {
            Route::get('data/datatables', [UserController::class, 'datatable'])->name('datatable');
            Route::post('activate/{id}', [UserController::class, 'activate'])->name('active');
            Route::post('bluck/delete', [UserController::class , 'bluckDestroy'])->name('bluck_delete');
        });
        /* ------------------------------------- User Routes --------------------------------- */

        /* ------------------------------------- Product Routes --------------------------------- */
        Route::resource('products', ProductController::class);
        Route::group(['prefix' => 'products', 'as' => 'products.'], function () {
            Route::get('data/datatables', [ProductController::class, 'datatable'])->name('datatable');
            Route::post('activate/{id}', [ProductController::class, 'activate'])->name('active');
            Route::post('bluck/delete', [ProductController::class , 'bluckDestroy'])->name('bluck_delete');
        });
        /* ------------------------------------- Product Routes --------------------------------- */


        /* ------------------------------------- Role Routes --------------------------------- */
        Route::resource('roles', RoleController::class);
        Route::group(['prefix' => 'roles', 'as' => 'roles.'], function () {
            Route::get('data/datatables', [RoleController::class, 'datatable'])->name('datatable');
        });
        /* ------------------------------------- Role Routes --------------------------------- */

        /* ------------------------------------- Settings Routes --------------------------------- */
        Route::group(['prefix' => 'settings', 'as' => 'settings.'], function () {
            Route::get('/', [SettingController::class , 'index'])->name('index');
            Route::post('update', [SettingController::class , 'update'])->name('update');
        });
        /* ------------------------------------- Settings Routes --------------------------------- */

        /* ------------------------------------- Orders Routes --------------------------------- */
        Route::resource('orders', OrderController::class);
        Route::group(['prefix' => 'orders', 'as' => 'orders.'], function () {
            Route::get('data/datatables', [OrderController::class, 'datatable'])->name('datatable');
            Route::post('add_invoice/{order_id}', [OrderController::class, 'addInvoice'])->name('add_invoice');
        });
        /* ------------------------------------- Orders Routes --------------------------------- */

        /* ------------------------------------- PaymentGateway Routes --------------------------------- */
        Route::resource('payment_gateways', PaymentGatewayController::class);
        Route::group(['prefix' => 'payment_gateways', 'as' => 'payment_gateways.'], function () {
            Route::get('data/datatables', [PaymentGatewayController::class , 'datatable'])->name('datatable');
            Route::post('activate/{id}', [PaymentGatewayController::class, 'activate'])->name('active');
        });
        /* ------------------------------------- PaymentGateway Routes --------------------------------- */

        /* ------------------------------------- Review Routes --------------------------------- */
        Route::resource('reviews', ReviewController::class);
        Route::group(['prefix' => 'reviews', 'as' => 'reviews.'], function () {
            Route::get('data/datatables', [ReviewController::class , 'datatable'])->name('datatable');
            Route::post('activate/{id}', [ReviewController::class, 'activate'])->name('active');
            Route::post('bluck/delete', [ReviewController::class , 'bluckDestroy'])->name('bluck_delete');

        });
        /* ------------------------------------- Review Routes --------------------------------- */

        /* ------------------------------------- Shipping Company Routes --------------------------------- */
        Route::resource('shipping_companies', ShippingCompanyController::class);
        Route::group(['prefix' => 'shipping_companies', 'as' => 'shipping_companies.'], function () {
            Route::get('data/datatables', [shippingCompanyController::class , 'datatable'])->name('datatable');
            Route::post('activate/{id}', [shippingCompanyController::class, 'activate'])->name('active');
        });
        /* ------------------------------------- Shipping Company Routes --------------------------------- */

        /* ------------------------------------- Attribute Routes --------------------------------- */
        Route::resource('attributes', AttributeController::class);
        Route::group(['prefix' => 'attributes', 'as' => 'attributes.'], function () {
            Route::get('data/datatables', [AttributeController::class , 'datatable'])->name('datatable');
            Route::post('activate/{id}', [AttributeController::class, 'activate'])->name('active');
            Route::get('{id}/values', [AttributeController::class, 'getAttributeValues'])->name('values');
        });
        /* ------------------------------------- Attribute Routes --------------------------------- */

        /* ------------------------------------- AttributeValue Routes --------------------------------- */
        Route::resource('attribute_values', AttributeValueController::class);
        Route::group(['prefix' => 'attribute_values', 'as' => 'attribute_values.'], function () {
            Route::get('data/datatables', [AttributeValueController::class , 'datatable'])->name('datatable');
            Route::post('activate/{id}', [AttributeValueController::class, 'activate'])->name('active');
        });
        /* ------------------------------------- AttributeValue Routes --------------------------------- */

        /* ------------------------------------- Coupons Routes --------------------------------- */
        Route::resource('coupons', CouponController::class);
        Route::group(['prefix' => 'coupons', 'as' => 'coupons.'], function () {
            Route::get('data/datatables', [CouponController::class, 'datatable'])->name('datatable');
            Route::post('activate/{id}', [CouponController::class, 'operations'])->name('active');
            Route::get('coupon/items', [CouponController::class, 'getItemsByType'])->name('type.items');
        });
        /* ------------------------------------- Coupons Routes --------------------------------- */

        /* ------------------------------------- Offers Routes --------------------------------- */
        Route::resource('offers', OfferController::class);
        Route::group(['prefix' => 'offers', 'as' => 'offers.'], function () {
            Route::get('data/datatables', [OfferController::class, 'datatable'])->name('datatable');
            Route::post('activate/{id}', [OfferController::class, 'operations'])->name('active');
            // Route::get('offer/items', [OfferController::class, 'getItemsByType'])->name('type.items');
        });
        /* ------------------------------------- Offers Routes --------------------------------- */

        /* ------------------------------------- StaticPages Routes --------------------------------- */
        Route::resource('static_pages', StaticPageController::class);
        Route::group(['prefix' => 'static_pages', 'as' => 'static_pages.'], function () {
            Route::get('data/datatables', [StaticPageController::class, 'datatable'])->name('datatable');
            Route::post('activate/{id}', [StaticPageController::class, 'operations'])->name('active');
        });
        /* ------------------------------------- StaticPages Routes --------------------------------- */

        /* ------------------------------------- HomeSections Routes --------------------------------- */
        Route::resource('home_sections', HomeSectionController::class);
        Route::group(['prefix' => 'home_sections', 'as' => 'home_sections.'], function () {
            Route::get('data/datatables', [HomeSectionController::class, 'datatable'])->name('datatable');
            Route::post('activate/{id}', [HomeSectionController::class, 'operations'])->name('active');
        });
        /* ------------------------------------- HomeSections Routes --------------------------------- */
        /* ------------------------------------- Add Routes --------------------------------- */
        Route::resource('adds', AddController::class);
        Route::group(['prefix' => 'adds', 'as' => 'adds.'], function () {
            Route::get('data/datatables', [AddController::class, 'datatable'])->name('datatable');
            Route::post('activate/{id}', [AddController::class, 'activate'])->name('active');
            Route::post('bluck/delete', [AddController::class , 'bluckDestroy'])->name('bluck_delete');
        });
        /* ------------------------------------- Slider Routes --------------------------------- */
        Route::resource('sliders', SliderController::class);
        Route::group(['prefix' => 'sliders', 'as' => 'sliders.'], function () {
            Route::get('data/datatables', [SliderController::class, 'datatable'])->name('datatable');
            Route::post('activate/{id}', [SliderController::class, 'activate'])->name('active');
            Route::post('bluck/delete', [SliderController::class , 'bluckDestroy'])->name('bluck_delete');
        });
        /* ------------------------------------- Galary Routes --------------------------------- */
        Route::resource('galaries', GalaryController::class);
        Route::group(['prefix' => 'galaries', 'as' => 'galaries.'], function () {
            Route::get('data/datatables', [GalaryController::class, 'datatable'])->name('datatable');
            Route::post('activate/{id}', [GalaryController::class, 'activate'])->name('active');
            Route::post('bluck/delete', [GalaryController::class , 'bluckDestroy'])->name('bluck_delete');
        });
        /* ------------------------------------- Question Routes --------------------------------- */
        Route::resource('questions', QuestionController::class);
        Route::group(['prefix' => 'questions', 'as' => 'questions.'], function () {
            Route::get('data/datatables', [QuestionController::class, 'datatable'])->name('datatable');
            Route::post('activate/{id}', [QuestionController::class, 'activate'])->name('active');
            Route::post('bluck/delete', [QuestionController::class , 'bluckDestroy'])->name('bluck_delete');
        });
        /* ------------------------------------- Service Routes --------------------------------- */
        Route::resource('services', ServiceController::class);
        Route::group(['prefix' => 'services', 'as' => 'services.'], function () {
            Route::get('data/datatables', [ServiceController::class, 'datatable'])->name('datatable');
            Route::post('activate/{id}', [ServiceController::class, 'activate'])->name('active');
            Route::post('bluck/delete', [ServiceController::class , 'bluckDestroy'])->name('bluck_delete');
        });
        /* ------------------------------------- Plan Routes --------------------------------- */
        Route::resource('planes', PlaneController::class);
        Route::group(['prefix' => 'planes', 'as' => 'planes.'], function () {
            Route::get('data/datatables', [PlaneController::class, 'datatable'])->name('datatable');
            Route::post('activate/{id}', [PlaneController::class, 'activate'])->name('active');
            Route::post('bluck/delete', [PlaneController ::class , 'bluckDestroy'])->name('bluck_delete');
        });
        /* ------------------------------------- Work Routes --------------------------------- */
        Route::resource('works', WorkController::class);
        Route::group(['prefix' => 'works', 'as' => 'works.'], function () {
            Route::get('data/datatables', [WorkController::class, 'datatable'])->name('datatable');
            Route::post('activate/{id}', [WorkController::class, 'activate'])->name('active');
            Route::post('bluck/delete', [WorkController ::class , 'bluckDestroy'])->name('bluck_delete');
        });
        /* ------------------------------------- Blog Routes --------------------------------- */
        Route::resource('blogs', BlogeControll::class);
        Route::group(['prefix' => 'blogs', 'as' => 'blogs.'], function () {
            Route::get('data/datatables', [BlogeControll::class, 'datatable'])->name('datatable');
            Route::post('activate/{id}', [BlogeControll::class, 'activate'])->name('active');
            Route::post('bluck/delete', [BlogeControll ::class , 'bluckDestroy'])->name('bluck_delete');
        });
        /* ------------------------------------- Blog Routes --------------------------------- */
        Route::resource('comments', CommentControll::class);
        Route::group(['prefix' => 'comments', 'as' => 'comments.'], function () {
            Route::get('data/datatables', [CommentControll::class, 'datatable'])->name('datatable');
            Route::post('activate/{id}', [CommentControll::class, 'activate'])->name('active');
            Route::post('bluck/delete', [CommentControll ::class , 'bluckDestroy'])->name('bluck_delete');
        });
        /* ------------------------------------- Contact Routes --------------------------------- */
        Route::resource('contacts', ContactController::class);
        Route::group(['prefix' => 'contacts', 'as' => 'contacts.'], function () {
            Route::get('data/datatables', [ContactController::class, 'datatable'])->name('datatable');
            Route::post('activate/{id}', [ContactController::class, 'activate'])->name('active');
            Route::post('bluck/delete', [ContactController ::class , 'bluckDestroy'])->name('bluck_delete');
        });
        /* ------------------------------------- Product Routes --------------------------------- */
    });

});
