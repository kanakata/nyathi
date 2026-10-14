<?php

namespace App\Providers;

use App\Http\Controllers\Controller;
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
    public function boot(Controller $controller): void
    {
        View::share("promo", $controller->promo());
        View::composer('*', function ($view) {
            ob_start(function ($html) {
                return str_replace(["\n", "\t", '  '], '', $html);
            });
            $html = $view;
            ob_flush();
            return $html;
        });
    }
}
