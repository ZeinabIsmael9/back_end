<?php
// cookie used in browser server 

ob_start();

setcookie('any','Test Cookie',time() + 3600);



ob_end_flush();