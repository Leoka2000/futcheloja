<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
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
    public function boot()
    {
        if ($this->app->environment('production')) {
            URL::forceScheme('https');

            // Set cookie configuration for CSRF
            config([
                'session.secure' => true,
                'session.same_site' => 'none',
                'session.domain' => null, // Let Laravel determine the domain
            ]);
        }
    }
}
