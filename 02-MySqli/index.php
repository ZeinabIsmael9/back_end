<?php

/* Connect to mysql database using mysqli connect */
$database_info = include __DIR__."/config/database.php";
//var_dump($database_info);
// try{
//     $connect = mysqli_connect($database_info['servername'],$database_info['username'],$database_info['password'],);
//     var_dump($connect);
// }catch(Exception $e){
//     throw new Exception($e->getMessage());
// }
$connect = mysqli_connect(
    $database_info['servername'],
    $database_info['username'],
    $database_info['password'],
    $database_info['dbname']
);
if(!$connect){
    die("connection failed ".mysqli_connect_error());
}
//Delete one user
mysqli_query($connect,"DELETE FROM user where id =1");
//Delete all user
// mysqli_query($connect,"DELETE * ");

$sql = "SELECT * FROM user /*where email='zeinab9@gmail.com'and name='zeinab'*//* order by id desc limit 1,3 offset 2*/";
$query = mysqli_query($connect,$sql);
$num = mysqli_num_rows($query);

//update 
mysqli_query($connect,"UPDATE user SET email ='zeinab@gmail.com' WHERE email ='zeinab8@gmail.com'");

if($num>0){
    while($row = mysqli_fetch_assoc($query)){
        echo $row['name'].'_'.$row['email']."<br>";
}
}
// $sql .= "INSERT INTO user(name,password,email,mobile)
//                 VALUES('Zeinab','12345678910','zeinab9@gmail.com','01554329176');";

// $sql .= "INSERT INTO user(name,password,email,mobile)
//                 VALUES('Zeinab','12345678911','zeinab10@gmail.com','01554329176');";

//$query = mysqli_multi_query($connect,$sql);
//$last_id = mysqli_insert_id($connect);
//echo "DataBase Connected Successfuly=>".$last_id;
//var_dump(mysqli_insert_id($connect));








mysqli_close($connect);
