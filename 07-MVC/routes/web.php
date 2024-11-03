<?php

use App\HTTP\Controllers\HomeController;
use Illuminates\Router\Route;


Route::get('/', HomeController::class ,'index');
Route::get( 'about', HomeController::class , 'about');
