<?php
// RegEx

/* Part 1  => preg_replace  */

$text = "Welcome IN PHP";
$text2 = "I Study php in PHP Anonymous Channel";
$pattern = '/study/i';
// echo str_replace('IN','to' , $text);
// echo "<br>";

echo preg_replace('/in/i','to' , $text);
echo "<br>";
echo preg_replace('/in/u','to' , $text);
echo "<br>";
echo preg_replace('/Welcome/m','Hi' , $text);
echo "<br>";
echo preg_replace('/PHP/i','Python' , $text);
echo "<br>";
echo preg_replace($pattern,"Learn", $text2);
echo "<hr>";

/* Part 2  => preg_match  */

$str = "PHP V 8.3" ;
$pattern = '/[0-9]/i';
$pattern2 = '/[a-zA-Z]/i';
$pattern3 = '/^[0-9]/i';
$pattern4 = '/[0-9]$/i';
echo preg_match($pattern,$str);
echo "<br>";
echo preg_match($pattern2,$str);
echo "<br>";
echo preg_match($pattern3,$str);
echo "<br>";
echo preg_match($pattern4,$str);
echo "<br>";
echo "<hr>";

/*Part 3  => preg_match with Metacharacters */

$str2 = "i have a zoo .. in this zoo we have acat and dog and more..";
//$pattern5 = '/cat|dog|fish/i';
$pattern5 = '/cat./i';
echo preg_match($pattern5,$str2);
echo "<br>";

//$pattern6 = '/p+/i';
$pattern6 = '/a+/i';
echo preg_match($pattern6,$str2);
echo "<br>";
echo "<hr>";


/*Part 4  => preg_match preg practice phone number */

$str3 = "20-123-4567-89";
$pattern7 = '/[0-9]{2}-[0-9]{3}-[0-9]{4}-[0-9]{2}/';
echo preg_match($pattern7,$str3);
echo "<br>";
echo "<hr>";


/*Part 5  => preg_split & preg_grep */
$str4 = "20-123-4567-89";
$pattern8 = '/[0-9]{2}-[0-9]{3}-[0-9]{4}-[0-9]{2}/';
preg_match($pattern8,$str4,$matches);
echo "<pre>";
var_dump($matches);
echo "</pre>";
echo "<br>";
echo $matches[0];
echo "<br>";

$str5 = "cat,dog,fish,zoo";
$pattern9 = '/[,\s]+/';
$matches = preg_split($pattern9,$str5);
echo $matches[0];
//$arr = explode(',',$str5);
//echo $arr[0];
echo "<br>";

$emails = ['cat@gmail.com','dog@gmail.com','fish@yahoo.com'];
$pattern10 = '/@gmail\.com$|@yahoo\.com$/i';
$outputs = preg_grep($pattern10,$emails);
var_dump(count($outputs),count($emails));
echo "<br>";
echo "<hr>";

/*Part 6  => search and get data from HTML tags */

//$str6 = " <p> Welcome in Html </p>";
$str6 = "<a href=\"Google.com\"> Click Here </a>";

//$pattern11 = '/ <p>(.*?)<\/p>/';
$pattern11 = '/<a href=\"(.*?)\">(.*?)<\/a>/i';
preg_match($pattern11,$str6,$outputs);
var_dump($outputs);
