<?php
if(!function_exists('storage')){
    function storage($path){

    }
}


if(!function_exists('storage_file')){
    function storage($from ,$to){
        $to_path = '/' . ltrim($to,'/');
        $path = config('files.storage_files_path') .$to_path ;
        move_uploaded_file($from , $path);
    }
}

