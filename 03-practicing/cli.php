<?php
// //STDIN
// if (!defined("STDIN")) {
//     define("STDIN", fopen("php://stdin", "r"));
// }
// //readline()
// $command = fgets(STDIN);
// $output = "You entered: " . $command . PHP_EOL;
// fwrite(STDOUT,$output);
// //echo $output;

//$argv
if( php_sapi_name()== 'cli'){
    $str = $_SERVER['argv'];

//var_dump($str,$argv);
if($str[1] == 'view:clear'){
    //echo 'views is cleared'.PHP_EOL;
    $path = 'storage/views';
    $files = glob($path.'/*');
    //var_dump($files);
    foreach ($files as $file) {
        if(file_exists($file)){
            unlink($file);
        }
        
    }echo "views is cleared ".PHP_EOL;
}
}

