<?php
class Student
{
    // public string $name;
    // public int $age;
    // public function __construct($name, $age)
    // {
    //     $this->name = $name;
    //     $this->age = $age;


    //OR

    // public function __construct(public string $name, public int $age)
    // {

    // }
    // public function __destruct()
    // {
    //     echo "Object destroyed\n";
    // }

    public function info(string  $name , int $age):mixed{
        return  $name.$age;
    }

}
// $student = new Student("Ahmed", 20);
// echo $student->name;
// echo "<br>";
// echo $student->age . PHP_EOL;

$student = new Student;
echo $student->info("Zeinab",22);
echo "<br>";
