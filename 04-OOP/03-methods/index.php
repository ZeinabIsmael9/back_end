<?php
class Student
{
    public string $name = "OOP";
    protected int $age = 20;
    private string $birth_date = "2002-09-22";
    public function myName(){
        return "Zeinab";
    }
    protected function myColor(){
        return "Red";
    }
    private function age(){
        return 22 ;
    }
}
class School extends Student
{
    public function myName(){
        return "Zeinab from class";
    }
    protected function myColor(){
        return "Red from class";
    }

    public function age(){
        return 22;
    }
    public function myAge()
    {
        //return $this->age();
        return $this->myColor();
    }
}

$student = new School();
echo $student->myName(); 
echo "<br>";
echo $student->myAge(); 
echo "<br>";