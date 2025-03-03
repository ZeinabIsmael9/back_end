<?php

use App\HTTP\Controllers\HomeController;
use App\Http\Middleware\SimpleMiddleware;
use Illuminates\Router\Route;
use Illuminates\Sessions\Session;

Route::get('contact', fn()=> 'welcome to contact page!');

// Route::get('/', HomeController::class , 'index');
Route::get('/', function () {
    return 'welcome to index page';
},[/*SimpleMiddleware::class,*/'simple,admin']);
Route::get( 'about', HomeController::class , 'about');

// Route::get('article/{id}', HomeController::class , 'article');
Route::get('article/{id}/{name}', function ($id, $name) {
    return 'Article ID: ' . $id . ' Name: ' . $name;
});


// Route::get('/', function () {
//     Session::make('massage from index page', 'Welcome to Elframework');
//     return Session::get('massage from index page');
// } ,['simple'::class]);