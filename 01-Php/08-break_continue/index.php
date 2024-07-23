<?php

$arr = ['php','v8',' data'];

for ($index=0; $index < count($arr) ; $index++) { 
    if($index == 1){
        echo "$arr[$index]<br>";
        break;
    }
}


$obj = new stdClass;
$obj->name = 'John Doe';
$obj->age = 30;

foreach ($arr as $key => $value) {
    if($key == 2){
        continue; 
    }
    echo "$value = $key <br>";
}