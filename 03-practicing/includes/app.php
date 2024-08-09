<?php
$helpers = ['request','routing','helper','AES','db', 'session','mail','translation','view'];
foreach ($helpers as $helper) {
    require __DIR__."/helpers/" .$helper.".php";
}

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

?>
