<?php

use App\HTTP\Controllers\HomeController;
use App\Http\Middleware\SimpleMiddleware;
use App\Http\Middleware\UserMiddleware;
use Illuminates\Router\Route;
use Illuminates\Sessions\Session;


// Route::group(['prefix' => 'site', 'middleware' => [SimpleMiddleware::class]], function () {
//     Route::get('/', function () {
//         return 'Welcome to Web Route!';
//     });
//     Route::get('/users', function () {
//         return 'Welcome to Users Web Route!';
//     }, [UserMiddleware::class]);
//     Route::get('/article/{id}/{name}', function () {
//         return 'Welcome to article Web Route!';
//     });
//     Route::get('/about', function () {
//         return 'Welcome to About Web Route!';
//     });
// });


// Route::get('/', [HomeController::class, 'index']);
Route::get('/', function () {
    return Session::get('locale');
});

Route::group(['prefix' => '/site/'], function () {
    Route::get('/', function () {
        return 'welcome to site index page!';
    });
    Route::get('/contact', fn() => 'welcome to contact page!');

    Route::get('/article/{id}/{name}', function ($id, $name) {
        return 'welcome to site article page! ' . $id . ' ' . $name;
    });
    Route::get('/about', function () {
        return 'Welcome to About Web Route!';
    });
});

// Route::get('contact', fn()=> 'welcome to contact page!');

// Route::get('/', HomeController::class , 'index');
// Route::get('/', function () {
//     return 'welcome to index page';
// },[/*SimpleMiddleware::class,*/'simple,admin']);

// Route::group(['prefix'=>'site'],function(){
//     Route::get('/article/{id}/{name}', function ($id, $name) {
//         return 'Article ID: ' . $id . ' Name: ' . $name;
//     });
//     Route::get('/about', [HomeController::class, 'about']);
// });

// Route::get('/', function () {
//     Session::make('massage from index page', 'Welcome to Elframework');
//     return Session::get('massage from index page');
// } ,['simple'::class]);