<?php

//for 

$arr =['php','v8','data'];

for( $index = 0; $index < count($arr); $index++){
    echo "$index <br>";
}
echo "<hr>";

//for each 

foreach($arr as $value){
    echo "$value <br>";
}
echo "<hr>";

$obj = new stdClass;
$obj->name = 'php';
$obj->version = '8';
foreach($obj as $key => $value){
    echo "$value =$key <br>";
}
echo "<hr>";
