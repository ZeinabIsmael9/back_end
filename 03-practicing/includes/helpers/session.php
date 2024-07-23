<?php
if(!function_exists('session')){
    function session(string $key , mixed $value=null):mixed{
        if(!is_null($value)){
            $_SESSION[$key] = $value;
        }
        return isset($_SESSION[$key])?$_SESSION[$key]:'';
    }
}



if(!function_exists('session_forget')){
    function session_forget(string $key ){
    if(isset($_SESSION[$key])){
        unset($_SESSION[$key]);
    }
    }
}


if(!function_exists('session_delete_all')){
    function session_delete_all(){
        session_destroy();
    }
}