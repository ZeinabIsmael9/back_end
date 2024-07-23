<?php
// Part 1
// = set value
// == check value
// === check value and data type
$a = 100;
if($a > 0){
    echo "Is Correct";
}

echo "<br>";

if($a >= 0){
    echo "Is Correct";
}
echo "<br>";

if($a == 0){
    echo "Is Correct";
}
echo "$a";
echo "<br>";

if($a === 100){
    echo "Is Correct";
}else{
    echo "Is Not Correct";
}
echo "<br>";
$b = "php";
if($b ==="php"){
    echo "Is Correct";
}
echo "<br>";

$c = 100;
if($c !=="php"){
    echo "Is Correct";
}else{
    echo "Is Not Correct";
}
echo "<br>";

$c = 100;
if($c =="php"){
    echo "Is Correct";
}else{
    echo "Is Not Correct";
}
echo "<br>";
echo "<hr>";

// Part 2

//else-if
// Named Ternary operator
$d = 100;

if($d ==="php"){
    echo "Is Correct";
}elseif($d === 100){
    echo " Is 100 ";
}elseif($d ===99){
    echo "Is 99";
}else{
    echo "Is Not Correct";
}
echo "<br>";

/* syntax 2 */

if($d ==="php"):
    echo "Is Correct";
elseif($d === 100):
    echo " Is 100 ";
elseif($d ===99):
    echo "Is 99";
else:
    echo "Is Not Correct";
endif;
echo "<br>";
echo "<hr>";

//Part 3

/* Short Hand | null colescing operator*/
$f = 100;
echo $f == 100?"Is 100":"Is Not 100";
echo "<br>";
echo $f ??"No Value"; // if $f is not null then it will print the value of $f else it will print "No Value"

echo "<hr>";

// Part 4

// Spaceship operator
echo 1<=> 2;
echo "<br>";
echo 2<=> 2;
echo "<br>";
echo 1<=> 0;

echo "<hr>";

// Part 5

// multi condition
// and , AND , &&
// or , OR , ||
$e = 100;
$g = 2000;
if($a === 100 /*and*/ && $g ==200){
    echo " is 100";
}else{
    echo "Is Not Correct";
}
echo "<br>";
if($a === 100 /*OR*/ || $g ===200){
    echo " is 100";
}
echo "<br>";

echo $e == 100 || $b ==200?"Correct": "Not Correct";
