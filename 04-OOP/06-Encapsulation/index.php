<?php

/** Encapsulation 166*/
// class Student{
//     public $name;
//     protected $age;
//     private $password;
//     public function myName(){
//         return 'test';
//     }

//     public function myAge(){
//         return 20;
//     }

//     private function myPassword(){
//         return '123456';
//     }
// }
// $student = new Student;
// echo $student->name;

/** Type hint in 167 */
// class Student{
//     public ?string $name=null;
//     public ?int $age=null;
//     public mixed $password=null;
// }
// $student = new Student;
// $student->name = "OOP";
// $student->age = 20;
// $student->password = "123456";
// if(!is_null($student->password)){
//     echo "password are failed";
// }else{
//     echo "need password";
// }
// // var_dump( $student->name);
// // var_dump( $student->age);

/** readonly props 168 */
class Student
{
    public readonly string $name;
    private readonly string $age;
    protected readonly string $password;

    public function __construct(string $name, $age, $password)

    {
        $this->name = $name;
        $this->age = $age;
        $this->password = $password;
    }

    public function changeMyName()
    {
        $this->name = "test";
    }
    public function myAge()
    {
        return $this->age;
    }
    public function myPassword()
    {
        return $this->password;
    }
}
// $student = new Student("OOP",20,123456);
// echo $student->name;

$student = new Student("Ahmed", 20, 1234546);
echo $student->name;
echo $student->myAge();
echo $student->myPassword();
 //$student->changeMyName("Ahmed");