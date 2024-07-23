<?php
$str = "<a href=\"google.com\"> Click Here </a>";

$str1 = "<a href='google.com'> Click Here </a>";

echo $str;
echo "<br>";
var_dump( addslashes($str1) );
echo "<br>";

echo (addslashes($str1));
echo "<br>";

$data = addslashes($str1);
echo stripslashes($data);
echo "<br>";
