<?php
/** interface 180 */
// interface used in only public method and donot used in prop
// interface Info{
//     public function getName();
//     public function school();
//     public function age();
//     public static function gender();
// }
// class User implements Info{
//     public function getName()
//     {
//         return "Zeinab ismael";
//     }
//     public function age(){
//         return 25;
//     }

//     public function school()
//     {
//         return "Cairo University";
//     }

//     public static function gender()
//     {
//         return "Female";
//     }

// }

// $user = new User;



/** abstract vs interface 181 */
abstract class UserMethods{
    public $name = "Zeinab";
    protected $age = 25;
    abstract public function age();
    abstract protected function color();
    abstract public static function gender();
    private function myInfo(){
        return "My Info";
    }
    public function bio(){
        return $this ->myInfo();
    }

}

class User extends UserMethods{
    public function age(){
        return $this->age;
    }
    protected function color(){
        
    }
    public static function gender(){
    }
}

// abstract class can have both public and protected and private methods
// abstract class can have both static and non-static methods
// abstract class can have both public and protected and private properties
// abstract class can have both static and non-static properties
$user = new User;
echo $user->name;
echo "<br>";
echo $user->age();
echo "<br>";
echo $user->bio();
echo "<br>";
