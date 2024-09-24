<?php
//class
class Student
{
    public string $name = "Zeinab";
    public int $age = 20;
    // public 
    // protected
    // private 

    // static public
    // static protected
    // static private
    public function test(){
        //class in function called method
        echo "Hello from student class";
    }
}

//object
$student = new Student();
echo $student->name ;
echo "<br>";
echo $student->test() ;
echo "<br>";
echo $student->age ;
echo "<br>";

