<?php

include "config.php";
echo $name;
echo "<br>";
echo $age;
echo "<br>";
echo $info;
echo "<hr>";

$file = include_once "config.php";
echo"<pre>";
var_dump($file);
echo "</pre>";
echo $name;
echo "<br>";
echo $age;
echo "<br>";
echo $info;
