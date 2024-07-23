<?php
    // $_GET and $_POST
    echo $_POST['username'];
    echo "<br>";
    echo $_REQUEST['username'];
    ?>
<form action="<?php echo $_SERVER[ 'PHP_SELF' ]; ?>" method="post">
    <input type="text" name="username">
    <input type="submit" value ="Send">

</form>
<?php

// echo "<pre>";
// var_dump($GLOBALS);
// echo "</pre>";

/* $_SERVER Global Variables */

echo $_SERVER['HTTP_HOST'];
echo "<br>";
echo "<a href='config.php'> Click Here </a>";
echo "<br>";

echo $_SERVER['HTTP_USER_AGENT'];
echo "<br>";

echo $_SERVER['SCRIPT_NAME'];
echo "<br>";

//echo $_GET['name'];
echo "<br>";

