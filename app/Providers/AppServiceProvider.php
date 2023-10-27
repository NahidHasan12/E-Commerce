<?php

namespace App\Providers;

use App\Models\Web_setting;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $web_settings = Web_setting::first();
        view()->share('web_settings',$web_settings);
    }
}
