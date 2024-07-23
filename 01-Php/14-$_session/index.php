<?php
ob_start();
session_start([
    'cookie_lifetime' => 86400,
]);

$_SESSION['any'] = 'Test Value';
//$_SESSION['any'] = null;
echo $_SESSION['any'];


ob_end_flush();