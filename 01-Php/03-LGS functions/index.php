<?php
$x = "10";
$y = "100";

//Global Scope

function calc(){
    // global $x ,$y;
    // echo $x * $y;
    echo $GLOBALS['x'];
}
calc();
echo"<br>";

//Local Scope
function calc2(){
    $x = 10;
    $y = 100;
    echo $x * $y;
}
calc2();
echo"<br>";

//Static Scope 
function calc3(){
    static $x = 10;
    echo $x;
    $x++;
}
calc3();