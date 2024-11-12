<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    protected function unauthenticated($request, array $guards)
    {
        throw new \Illuminate\Auth\AuthenticationException(
            'Unauthenticated.', $guards
        );
    }

    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {
            return null; // Retorne null para APIs
        }
    }
}
