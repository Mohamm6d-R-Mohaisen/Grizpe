<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Setting;
use App\Services\CheckoutService;
use App\Services\Payment\PaymentGateways\PaymentGatewayManager;
use App\Services\Payment\PaymentGateways\TelrGateway;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(PaymentGatewayManager::class, function ($app) {
            return new PaymentGatewayManager();
        });

        $this->app->bind(CheckoutService::class, function ($app) {
            return new CheckoutService();
        });

        $this->app->bind(TelrGateway::class, function ($app) {
            return new TelrGateway();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if(env('APP_SECURE')){
            URL::forceScheme('https');
        }

        View::composer('*', function ($view) {
            $lang = app()->getLocale();
            $settings = new Setting();
            $shared_categories = Category::active()->get()->take(5);

            if ($lang !== LaravelLocalization::getCurrentLocale()) {
                app()->setLocale(LaravelLocalization::getCurrentLocale());
            }

            // if(auth()->check()){
            //     $user = auth()->user();
            // }

            $cart_count = 0;
            if (session('cart_count', getCartCountFromCookies()) > 0) {
                $cart_count = session('cart_count', getCartCountFromCookies());
            } elseif(auth()->check() && auth()->user()->cart){ 
                $cart_count = auth()->user()->cart->products->count();
            }

            $view->with([
                'java_version' => now()->timestamp,
                'lang' => $lang,
                'settings' => $settings,
                'shared_categories' => $shared_categories,
                'shared_cart_count' => $cart_count,
            ]);
        });
    }
}
