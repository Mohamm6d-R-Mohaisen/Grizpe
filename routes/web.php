<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ShopController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\NewsController;
use App\Http\Controllers\Frontend\OrderController;
use App\Http\Controllers\Frontend\WorkController;
use App\Http\Controllers\Frontend\StaticPageController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\ServicesController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

// Route::get('/', function () {
//     return view('welcome');
// });
//Auth::routes();

Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]], function(){
//     Auth::routes();

    Route::post('login', [LoginController::class, 'login'])->name('login');
    Route::post('register', [RegisterController::class, 'register'])->name('register');
//    Route::get('register', [RegisterController::class, 'index']);
    //     Route::post('send_reset_otp', [ForgotPasswordController::class, 'sendResetOTPCode'])->name('send_reset_otp');
    //     Route::post('reset_password', [ForgotPasswordController::class, 'resetPassword'])->name('reset_password');
//    ******************Start front Route *******************
//    **********************Start Home Route******************************
    Route::get('/', [HomeController::class, 'home'])->name('home');


//    *********************End Home Route ********************
//***************************Start Service Route*******************
    Route::get('/services', [ServicesController::class, 'services'])->name('services');
    Route::get('/services/{id}', [ServicesController::class, 'services_detail'])->name('services_detail');

    //***************************End Service Route*******************
    //***************************Start Static Page Route*******************
    Route::get('/about', [StaticPageController::class, 'about'])->name('about');
    Route::get('/faq', [StaticPageController::class, 'faq'])->name('faq');
    Route::get('/pricing', [StaticPageController::class, 'pricing'])->name('pricing');
    Route::get('/contacts', [StaticPageController::class, 'contact'])->name('contacts');

    //***************************End Static Page Route*******************
    //***************************Start Work Page Route*******************
    Route::get('/work', [WorkController::class, 'work'])->name('work');
    Route::get('/work/{id}', [WorkController::class, 'work_detail'])->name('work_detail');
    //***************************End Work Page Route*******************
    //***************************Start News Page Route*******************
    Route::get('/news', [NewsController::class, 'news'])->name('news');
    Route::get('/news/{id}', [NewsController::class, 'news_detail'])->name('news_detail');
    Route::post('/comment',[NewsController::class, 'store'])->name('store_comment');
    //***************************End News Page Route*******************


//    *********************End Front Route*********************
    Route::get('category/{category:slug}', [HomeController::class, 'show'])->name('category.show');
    Route::get('shop', [ShopController::class, 'index'])->name('z0');
    Route::get('product/{product:slug}', [ShopController::class, 'getProduct'])->name('product.show');
    Route::get('products/filter', [ShopController::class, 'filter'])->name('products.filter');
    // Route::post('cart/add', [CartController::class, 'addProductToCart'])->name('cart.add');
    // Route::post('cart/remove', [CartController::class, 'removePrductFromCart'])->name('cart.remove');
    // Route::get('cart', [CartController::class, 'getCartDetails'])->name('cart.index');
    Route::get('page/{slug}', [StaticPageController::class, 'show'])->name('static_pages.show');
    // Route::post('apply-coupon', [CartController::class, 'applyCoupon'])->name('apply.coupon');

    // In your web.php routes file
    Route::get('/sell-your-device', function () {
        return view('sell-device');
    })->name('sell.device');

    // Route::get('categories/{categoryId}/products', [HomeController::class, 'showProducts'])->name('categories.products');
    // Route::get('products/{productId}/details', [HomeController::class, 'showProductDetails'])->name('products.details');

    Route::get('api/categories', [HomeController::class, 'getAllCategories']);
    Route::get('api/categories/{category}/products', [HomeController::class, 'getProductsByCategory']);
    Route::get('api/products/{product}/variants', [HomeController::class, 'getProductVariants']);
    Route::get('api/products/{product}/details', [HomeController::class, 'getProductDetails']);
    Route::get('api/products/{product}/years/{year}/memories', [HomeController::class, 'getMemorySizeByYear']);
    Route::get('api/products/{product}/memory/{memory}/conditions', [HomeController::class, 'getConditionByMemorySize']);
    Route::get('api/calculate-price', [HomeController::class, 'calculatePrice']);
    Route::get('api/cities/{state}', [HomeController::class, 'getCitiesByState']);
    Route::get('api/products/search', [HomeController::class, 'search']);

    Route::post('api/checkout', [OrderController::class, 'checkout'])->name('order.checkout');

    Route::group(['middleware' => ['auth']], function () {
        // Route::get('checkout', [OrderController::class, 'getCheckoutPage'])->name('order.checkout.index');

        // Route::get('profile', [UserController::class, 'profile'])->name('user.profile');
        // Route::post('profile/update', [UserController::class, 'updateProfile'])->name('user.profile.update');
        // Route::get('orders', [OrderController::class, 'index'])->name('orders.index');
    });
});
