<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;

class CustomCsrfMiddleware extends VerifyCsrfToken
{
    protected $except = [
        '/auth-custom/*',
    ];
}
