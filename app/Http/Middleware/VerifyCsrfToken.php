<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        // 排除csrf验证的路由
        'home/test/test7',
        'faq/api/*'
    ];

    // 排除所有路由则可以写通配符'*'
}
