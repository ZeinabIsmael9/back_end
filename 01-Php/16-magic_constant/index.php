<?php

//__DIR__ for directory
echo __DIR__;
echo"<br>";

// __FILE__ for full path
echo __FILE__;
echo"<br>";

//__LINE__ for the current line in the php file
echo __LINE__;
echo"<br>";

//__METHOD__
echo __METHOD__;
echo"<br>";

//__CLASS__
echo __CLASS__;
echo"<br>";

//__FUNCTION__
function php_func(){
    echo __FUNCTION__;
}
echo php_func();
echo"<br>";

//__TRAIT__
echo __TRAIT__;
echo"<br>";

//__NAMESPACE__
echo __NAMESPACE__;
echo"<br>";
