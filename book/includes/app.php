<?php
ob_start();

// Correct the path to helper files
$helpers = ['bcrypt','request', 'routing', 'helper','AES', 'db', 'session','auth', 'mail','translation','validation','view','storage','media'];
foreach ($helpers as $helper) {
    require __DIR__ . "/helpers/" . $helper . ".php";
}

session_save_path(config('session.session_save_path'));
ini_set('session.gc_probability',1);

$cookieLifetime = config('session.timeout');
session_start([
    'cookie_lifetime' => $cookieLifetime
]);

// Database connection using mysqli
$servername = config('database.servername');
$username = config('database.username');
$password = config('database.password');
$dbname = config('database.dbname');

if (!$servername || !$username || !$dbname) {
    die("Database configuration values are missing. Please check your config file.");
}

$connect = mysqli_connect($servername, $username, $password, $dbname);
if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
}

// echo 'app.php work';

// echo session('loacle');
require_once base_path('/routes/web.php');
require_once base_path('/includes/exception_error.php');

