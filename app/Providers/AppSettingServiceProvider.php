<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Setting;

class AppSettingServiceProvider extends ServiceProvider
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
    // Share app settings with ALL views
    view()->composer('*', function ($view) {
        $view->with('appSetting', Setting::first());
    });
}
}
