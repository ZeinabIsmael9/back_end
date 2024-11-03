<?php

/**
 * Run Composer Autoloader
 */
require __DIR__ . '/../vendor/autoload.php';

/**
 *  Run the frame work
 */
(new \Illuminates\Application)->start();
//OR
// use App\Illuminates\Application
// $application = new Application;
// $application->start();



// $router->add('GET', 'about', HomeController::class , function () {
//     echo 'Welcome To about page!';
// }, []);

// DEBUG: Check the full request URI
// var_dump($_SERVER['REQUEST_URI']); // Expecting "/back_end/07-MVC/public/about"

// echo "<pre>";
// var_dump($router->routes());
// echo "</pre>";

