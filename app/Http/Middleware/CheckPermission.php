<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckPermission
{
    public function handle($request, Closure $next, $permission)
    {
        if (!Auth::user()->can($permission)) {
            return response()->json(['message' => 'You do not have permission to access this resource'], 403);
        }

        return $next($request);
    }
}

