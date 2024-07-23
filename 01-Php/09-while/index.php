<?php

// While
$index = 0;
$arr = ["php", "v8"];
while($index < 2):
    if($index == 1){
        echo $arr [$index]."<br/>";
        break;
    }
    $index++;
    endwhile;


//Do While

do{
    echo $index;
    $index++;
}while($index < 2);
