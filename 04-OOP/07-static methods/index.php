<?php
/** non static methods 170*/
// class Cars
// {
//     const  VERSION ='1.0';
//     public static $name = "My Cars Class";
//     protected static $age = "20";
//     private static $hp = "1600";
//     //non static method
//     public function model() {
//         // return $this::$name ."Toyota";
//         // return $this::$age ;
//         return $this::$hp ;
//     }

//     //static method
//     public static function color()
//     {
//         return "Red";
//     }
//     protected static function wheel(){
//         return "4 wheels";
//     }
//     public function data(){
//         return static::wheel();
//     }
// }

// $cars = new Cars;
// echo $cars->model() . "<br>"; 
// // echo $cars->data() . "<br>";

// // echo $cars::$name . "<br>"; 
// // echo Cars::color() . "<br>";
// // echo Cars ::VERSION  . "<br>";

/** run class in to self 171 & singleton class 172 */
class MyCars {
    private static $run = null;
    public $name;
    
    private function __construct($name) {
        $this->name = $name;
    }

    public static function data($val) {
        if (is_null(static::$run)) {
            static::$run = new self($val);
        }
        return static::$run;
    }

    private function __clone()
    {
        
    }

    // public function __wakeup()
    // {
        
    // }
}

$cars = MyCars::data("Rolls Royce");
echo $cars->name . "<br>"; // Rolls Royce

$cars = MyCars::data("Toyota");
echo $cars->name . "<br>"; // Rolls Royce (the object is already created and reused)

