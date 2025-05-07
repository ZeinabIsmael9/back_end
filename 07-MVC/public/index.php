<?php
define("ROOT_PATH", dirname(__FILE__));
define("ROOT_DIR",'/public/');
//UTC
// var_dump(date_default_timezone_get(),date('Y-m-d H:i:s'));
// echo "<br>";
/**
 * Run Composer Autoloader
 */
require __DIR__ . '/../vendor/autoload.php';

/**
 *  Run the frame work
 */
(new \Illuminates\Application)->start();
//Set Time Zone
// var_dump(date_default_timezone_get(),date('Y-m-d H:i:s'));
// في index.php أو ملف التحميل الرئيسي

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

