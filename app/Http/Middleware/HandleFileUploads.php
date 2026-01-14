<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class HandleFileUploads
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->is('livewire/upload-file')) {
            config(['session.same_site' => 'none']);
            config(['session.secure' => true]);
        }

        return $next($request);
    }
}
