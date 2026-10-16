<?php

namespace App\Providers;

use App\Http\Controllers\AdsController;
use App\Http\Controllers\user\AdsController as UserAdsController;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(UserAdsController $controller): void
    {
        View::share("promo", $controller->promo());
        View::composer('*', function ($view) {
            ob_start(function ($html) {
                return str_replace(["\n", "\t", "    "], "", $html);
            });
            $html = $view;
            ob_flush();
            return $html;
        });
    }
}
