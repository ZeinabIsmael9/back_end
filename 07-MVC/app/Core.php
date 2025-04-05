<?php

namespace App;

class Core
{
    public static $globalWeb = [
        \Illuminates\Sessions\Session::class
    ];

    public static $middlewareWebRoute = [
        'simple' => \App\Http\Middleware\SimpleMiddleware::class,
        'admin' => \App\Http\Middleware\AdminMiddleware::class,
        'user' => \App\Http\Middleware\UserMiddleware::class
    ];

    public static $middlewareApiRoute = [];

    public static $globalApi = [];
}