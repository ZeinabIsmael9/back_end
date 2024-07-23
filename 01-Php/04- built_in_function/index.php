<?php
function calc(){
    echo"welcome";
}
var_dump(function_exists('calc'));
echo"<br>";

$a = "Welcome TO PHP";
echo str_word_count($a);
echo"<br>";

$arr =['php','v8'];
echo count($arr);
echo "<br>";

echo str_replace('TO','IN',$a);
echo "<br>";

$result = explode(' ',$a);
var_dump($result);
echo "<br>";

echo implode(' , ',$arr);
echo "<br>";

$str = "|PHP V8|";
echo ltrim($str ,'|');
echo "<br>";

//echo phpinfo();
$str2= "welcome to php";
echo strtoupper($str2);
echo "<br>";

echo strlen($str2);
echo "<br";

$str3 = "lolo";
echo substr($str3,1);
echo "br";

define('PHPINFO',"PHPV8.3");
echo PHPINFO;