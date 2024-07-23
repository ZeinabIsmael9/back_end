<?php
ob_start();
require_once __DIR__."/includes/app.php";
session_start([
    'cookie_lifetime'=>config('session.expiration_timeout')
]);


//var_dump(config('session.expiration_timeout'));


// var_dump(db_create('user',[
//     'name'=>'zeinab',
//     'email'=>'php11@gmail.com'
// ]));

// db_update('user', [
//     'name' => 'test',
//     'email' => 'test@test.com',
// ], 5);

//db_delete('user',5);

//db_find('user',4);

// $search = db_frist('user','where email="zeinab554@gmail.com" and name like "%zeinab%"');
// var_dump($search);

//$search = db_frist('user','where email="zeinab554@gmail.com" and name like "%zeinab%"');


// $user = db_get('user','where email="zeinab554@gmail.com"');
// if($user['num']>0){
//     while($row = mysqli_fetch_assoc($user['query'])){
//         echo $row['name']."<br>";
//     }
// }

//set Data
session('test','test data from function ');
//get Data
echo session('test');

//destroy session by key name
//session_forget('test');

//destroy all session 
session_delete_all();

if(!empty($GLOBALS['query'])){
    //var_dump($GLOBALS['query']);
    mysqli_free_result($GLOBALS['query']);
}

mysqli_close($connect);
//ob_end_clean();
ob_end_flush();
