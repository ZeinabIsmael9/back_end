<?php
/** constant and props 160 */
// define('test', 'Data');
// class Student
// {
//     // public const NAME = "Ahmed";
//     // protected const NAME = "Ahmed protected";

//     // public function name(){
//     //     return $this::NAME;
//     // }
//     private const NAME = "Ahmed private";
//     //     public function name()
//     //     {
//     //         return self::NAME;
//     //     }
// }
// class School extends Student
// {
//     //public const NAME = "Ahmed from class";
//     private const NAME = "Ahmed from class";
//     public function name()
//     {
//         //return parent::NAME;
//         //return self::NAME;
//         return $this::NAME;
//     }
// }

// $student = new Student();
// //  echo $student->name();
// // echo $student::NAME;

// $student = new School();
// echo $student->name();

/** overwrite 161 */
class Student{
    public $name = "OOP IN PHP";
    public $age;
}
//$student = new Student();
$student = new Student;
$student->name = "New Value In OOP";
echo $student->name;
echo "<br>";
var_dump($student->age) ;
