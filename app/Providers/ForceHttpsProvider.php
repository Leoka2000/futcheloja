<?php

namespace App\Providers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class ForceHttpsProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->environment('production')) {
            URL::forceScheme('https');

            // Trust all proxy headers
            $this->app->make(Request::class)->setTrustedProxies(
                ['0.0.0.0/0'],
                Request::HEADER_X_FORWARDED_FOR |
                    Request::HEADER_X_FORWARDED_HOST |
                    Request::HEADER_X_FORWARDED_PORT |
                    Request::HEADER_X_FORWARDED_PROTO |
                    Request::HEADER_X_FORWARDED_AWS_ELB
            );
        }
    }
}
