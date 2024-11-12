<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    protected $routeMiddleware = [
        'auth' => \App\Http\Middleware\Authenticate::class,
        'auth.jwt' => \Tymon\JWTAuth\Http\Middleware\Authenticate::class,
    ];

    protected $primaryKey = 'USUARIO_ID';
} 