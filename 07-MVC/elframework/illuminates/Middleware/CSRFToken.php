<?php

namespace Illuminates\Middleware;

use Illuminates\Http\Request;
use Illuminates\Logs\Log;
use Illuminates\Sessions\Session;

class CSRFToken
{
    public static function handle()
    {
        if (in_array(strtoupper($_SERVER['REQUEST_METHOD']), ['POST', 'PUT', 'DELETE']) &&
            (empty(Request::get('_token')) || Request::get('_token') !== Session::get('csrf_token'))) {
            throw new \Exception('Invalid CSRF Token');
        }
    }

    public static function generateCSRFToken(): string
    {
        return bin2hex(random_bytes(32));
    }
}
