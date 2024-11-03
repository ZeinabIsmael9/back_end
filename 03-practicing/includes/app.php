<?php
ob_start();
$helpers = ['bcrypt','request','routing','helper','AES','db', 'session','auth','mail','translation','api','validation','storage','view','media'];
foreach ($helpers as $helper) {
    require __DIR__."/helpers/" .$helper.".php";
}


/**
 *  session save path
 *  with set ini and start session
 */
session_save_path(config('session.session_save_path'));
ini_set('session.gc_probability',1);
//ini_set('session.save_path',config('session.session_save_path'));
session_start([
    'cookie_lifetime'=>config('session.expiration_timeout')
]);

$connect = mysqli_connect(
    config('database.servername'),
    config('database.username'),
    config('database.password'),
    config('database.dbname'),
    
);
//query = "";
if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
}
//echo "Connection successful";
$user = db_paginate($connect,"user","",2);
// print_r($user);


require_once base_path("/routes/web.php");
require_once base_path("/includes/exception_error.php");

