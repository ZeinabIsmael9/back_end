<?php

/** #186 Recursion in php native and OOP */

class Calcs
{
    public static function calc($num)
    {
        echo $num . "<br>";
        if ($num < 10) {
            static :: calc($num + 1);
        } else {
            echo "Calc Function done";
        }
    }
}
$calc = Calcs::calc(1);

// function calc ($num){
//     echo $num."<br>";
//     if($num<5){
//         calc($num+1);
//     }else{
//         echo "Calc Function done";
//     }
// }

// calc(1);
