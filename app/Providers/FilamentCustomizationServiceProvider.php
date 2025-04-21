<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class FilamentCustomizationServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        Blade::directive('filamentMeta', function () {
            return <<<'HTML'
                @push('filament::head')
                    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
                @endpush
            HTML;
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
