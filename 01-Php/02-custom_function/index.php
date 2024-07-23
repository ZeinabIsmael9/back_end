<?php
/* Part 1 */
function calc(int $x, int $y):mixed{
    //echo $x * $y;
    return $x * $y;
}
$x = "10";
$y = "100";
//calc(10,20);
echo"<br>";
//echo calc(30,20);
$calc = calc($x , $y);
var_dump($calc);
echo"<hr>";
?>
<?php
/* Part 2 */
function calcu(...$args):array{
    echo $args[0];
    return $args;
}
$x = "10";
$y = "100";
$calcu = calcu($x , $y,null, true,"Data From PHP");
echo"<pre>";
var_dump($calcu);
echo"</pre>";
?>