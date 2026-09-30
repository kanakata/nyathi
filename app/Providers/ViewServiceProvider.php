<?php

namespace App\Providers;

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
    public function boot(): void
    {
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
