<?php

use Illuminates\Router\Route;

Route::get('/api',function () {
    return 'Welcome to Api Route!';
});
Route::get('/api/users',function () {
    return 'Welcome to Users Api Route!';
});