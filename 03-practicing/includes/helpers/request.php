<?php
if(!function_exists('request')){
    /**
     * request to get value from superglobal $_GET or $_POST
     * @param string|null $request
     * @return mixed
     */
    function request(string $request = null){
        return isset($_REQUEST[$request])? $_REQUEST[$request] :null;
        
    }
}