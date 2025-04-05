<?php

use App\Http\Middleware\SimpleMiddleware;
use App\Http\Middleware\UserMiddleware;
use Illuminates\Router\Route;

Route::group(['prefix' => 'api', 'middleware' => [SimpleMiddleware::class]], function () {
    Route::get('/', function () {
        return 'Welcome to Api Route!';
    });
    Route::get('/users', function () {
        return 'Welcome to Users Api Route!';
    }, [UserMiddleware::class]);
    Route::get('/article', function () {
        return 'Welcome to article Api Route!';
    });
    Route::get('/about', function () {
        return 'Welcome to About Api Route!';
    });
});