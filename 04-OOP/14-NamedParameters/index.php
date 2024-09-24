<?php
/**#187 Named parameters */

namespace App;
// class User
// {
//     public function __construct(public $name, public  $email = null, protected $age = null)
//     {
//         echo $name . " = " . $email . " = " . $age;
//     }
// }

// $user = new User(
//     name: "Zeinab",
//     email: "Zeinab@gmail.com",
//     age: '20'
// );
// echo "<br>";

// echo $user->name;
// echo "<br>";
// function data($Name, $email, $age)
// {
//     echo $Name . " = " . $email . " = " . $age;
// }
// data(
//     Name: "Zeinab",
//     email: "Zeinab@gmail.com",
//     age: '20'
// );
// echo "<br>";


/**#188 Preventing inheritance class or methods through final */

// trait info{

// }

// interface Rule{

// }

// abstract class Myinfo{

// }

// /*final */class MainUser{
//     // final public $name,
//     public function __construct( public $name,public  $email = null, protected $age = null )
//     {
        
//     }
//     final public function name(){
//         return $this->name;
//     }
//     final protected function age(){
//         return $this->age;
//     }
//     final private function email(){
//         return $this->email;
//     }
// }
// class User extends MainUser{
//     // final public function name(){
//     //     return $this->name;
//     // }
//     // final protected function age(){
//     //     return $this->age;
//     // }
//     // final private function email(){
//     //     return $this->email;
//     // }
// }

// $user = new User(
//     name: "Zeinab",
//     email: "Zeinab@gmail.com",
//     age: '20'
// );
// echo $user->email;


/** #189 Enumeration (enum) in OOP */

// enum Status:string{
//     case Active ='Active';
//     case Inactive ='Inactive';
//     case Ban = 'Ban';
// }

// echo Status::Active->value;


// enum Status{
//     case Active ;
//     case Inactive ;
//     case Ban ;

//     public static function status($value){
//         return Status::Active->name == $value? Status::Active->name:'Not Active';
//     }
// }

// // echo Status::Active->name;
// echo Status::status('Active');



enum Status: string
{
    // case Found = '200';
    // case NotFound = '404';
    // public static function status($value)
    // {
    //     return $value === Status::Found->value ? Status::Found->name : Status::NotFound->name;
    // }

    case Active ='Active';
    case Ban ='Ban';
    case Pending = 'Pending';
    public static function status($value)
    {
        return match($value)
        {
            Status::Pending->value => Status::Pending->value,
            Status::Active->value => "User Is Active",
            Status::Ban->value => Status::Ban->name,
        };
    }
}


echo Status::status('Active');