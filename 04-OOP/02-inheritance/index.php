<?php
class Student
{
    public string $name = "OOP";
    protected int $age = 20;
    private string $birth_date = "2002-09-22";
    // public function test(){
    //     echo "Hello, I'm Zeinab and I'm 20 years old.";
    // }
    public function myAge()
    {
        return $this->birth_date;

    }

}
class School extends Student
{
    // public string $name = "OOP from school class";
    // protected int $age = 22;
    // private string $birth_date = "2001-09-22";
    public function myAge()
    {
        return $this->age;
         //return $this->birth_date; //error because we use the private property only in the same class or we write in a public function
    }
}

 $student = new Student();
// echo $student->test() ;
// echo "<br>";
// echo $student->name;
// echo "<br>";
// echo $student->age ; // error because it protected 
// echo "<br>";

$student = new School();
echo $student->name;
echo "<br>";
echo $student->myAge(); // it works because it in a public function
echo "<br>";
