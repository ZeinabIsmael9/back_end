<?php

/** #185 Chaining Methods in OOP */

namespace App;

// non static methods
// class User{
//     public $name;
//     public $email;
//     public function name($name){
//         $this->name = $name;
//         return $this;
//     }
//     public function email($email){
//         $this->email = $email;
//         return $this;
//     }
// }

// $user = (new User)->name("Zeinab")->email("zeinab@gmail.com");

// echo $user->name." = ".$user->email;
// echo"<br>";


// static methods
class User
{
    public static $where;
    protected static $table = 'users';
    public static function where($col, $val)
    {
        static ::$where .= 'and where '. $col.'='. '"'.$val.'"' ;
        return new self;
    }
    public static function get()
    {
        $where = ltrim(static :: $where,' and ');
        return 'select * from '.static::$table.' '.$where;
    }
}

$user =  User::where(" name ", " Zeinab " )
->where(" email ", " Zeinab@test.com " )
->where(' gender','female')->get();

echo $user;
echo "<br>";
