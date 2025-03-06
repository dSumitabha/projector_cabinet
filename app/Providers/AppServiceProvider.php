<?php

namespace App\Providers;

use App\Models\Cart;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        require_once app_path('helpers.php');
         Paginator::useBootstrap();


         View::composer('*', function ($view) {
            $cartCount = Cart::where(function ($query) {
                if (Auth::check()) {
                    $query->where('user_id', Auth::id());
                } else {
                    // Use cookie_id instead of session_id for guest users
                    $cookieId = Cookie::get('cart_cookie_id');

                    if ($cookieId) {
                        $query->where('cookie_id', $cookieId);
                    } else {
                        // If no cookie exists, return count as 0
                        $query->whereNull('id');
                    }
                }
            })->count();

            $view->with('cartCount', $cartCount);
        });
    }
}
