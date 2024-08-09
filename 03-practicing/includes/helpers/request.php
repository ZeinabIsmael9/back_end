<?php
if(!function_exists('request')){
    function request(string $request = null){
        return isset($_REQUEST[$request])? $_REQUEST[$request] :null;
        
    }
}