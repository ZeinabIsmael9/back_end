<?php
trait AdvancedInfo
{
    //public $gender = "male";

    public function school()
    {
        return "High School";
    }

    public function color()
    {
        return "white";
    }
}


trait BasicInfo
{
    public $gender = "Female";

    public function name()
    {
        return "Zeinab Ismael";
    }
    public function birth()
    {
        return "22-09-2002";
    }
}

trait Users{
    public function bio(){
        return "I am a developer";
    }
}


interface School{
}

class User implements School
{
    use AdvancedInfo, BasicInfo,Users;
}

$user = new User;
echo $user->name();
echo "<br>";
echo $user->school();
echo "<br>";
echo $user->birth();
echo "<br>";
echo $user->color();
echo "<br>";
echo $user->gender;
echo "<br>";
echo $user->bio();
echo "<br>";
