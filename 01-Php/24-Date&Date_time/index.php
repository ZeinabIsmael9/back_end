<?php
echo time();
echo "<br>";
echo date("Y-m-d H:i:s");
echo "<br>";
date_default_timezone_set("Africa/Cairo");
echo date_default_timezone_get();
echo "<br>";
echo time()- 3600;
