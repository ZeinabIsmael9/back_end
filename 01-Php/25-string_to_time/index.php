<?php
/* Part 1 => string to time and add extra date or time using strtotime function */
$date = "2024-01-10 12:37:50";
$new_date= strtotime($date);
$extra = strtotime("+1 day",$new_date);
$final = date('y-m-d h:i:s',$extra);
echo $final;
echo "<hr>";


/* Part 2 =>  parse and diff and check date */
$parse = date_parse($final);
$currentDate = getdate();
var_dump($currentDate);
date_default_timezone_set("Africa/Cairo");
$date2 = date_create("2024-07-02");
$date1 = date_create("2025-09-22");
//echo date_format($date,"Y/m/d");
$diff= date_diff($date1 , $date2);
var_dump($diff);
echo "<br>";
echo $diff->days;
echo "<br>";
$checkdate = checkdate(01,10,2024);
var_dump($checkdate);
echo "<hr>";

/* Part 2 =>  get timezone identifiers list and other format in date function */
date_default_timezone_set("Africa/Cairo");
echo date('l jS \of F Y h:i:s A');
echo "<br>";
echo date('F M Y');
echo "<br>";
echo date('l jS \of F Y h:i:s P');
echo "<br>";
echo "Jan 15, 2024 was on ".date("l" , mktime(0,0,0,01,15,2024));
echo "<br>";

$tz = timezone_identifiers_list();
// var_dump($tz);
foreach($tz as $t){
    echo $t."<br>";
}