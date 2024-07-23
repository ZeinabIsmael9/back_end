<?php
// Change directory

// echo getcwd();
// chdir('public');
// echo "<br>";
// echo getcwd();
// echo "<hr>";

// Chick directory
//$current = getcwd();
//$directory = dir($current.'/public');
//$directory = opendir($current.'/public');
//var_dump($directory);
// echo $directory->handle;
// echo "<br>";
// echo $directory->path;
// echo "<br>";
// var_dump($directory->read());
// echo "<br>";
//while (($files = $directory->read()) !== false){

if(is_dir('public')){
    $directory = opendir('public');
    while (($files = readdir($directory)) !== false){
        echo $files."<br>";
    }
    rewinddir();
    closedir($directory);
}

//$directory ->close();

// $path = "images";
// var_dump( is_dir($path));

//Scan Dir
$dir = scandir('public',1);

foreach($dir as $files){
    echo $files."<br>";
}