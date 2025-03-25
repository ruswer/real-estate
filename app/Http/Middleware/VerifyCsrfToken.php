<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    protected $except = [
        // Agar CSRF'dan istisno qilish kerak bo‘lsa, shu yerga qo‘shing
    ];
}
