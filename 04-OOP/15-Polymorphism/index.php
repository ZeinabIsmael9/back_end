<?php

/** #190 Polymorphism in OOP */

namespace App;

class Animal
{
    public $name = "Animal";
    public function makeSound()
    {
        echo "This animal makes a sound" . "<br>";
    }
}
class Cat extends Animal
{
    // public $name="Kitty";
    public function makeSound()
    {
        echo "Meow" . "<br>";
    }
}
class Dog extends Cat
{
    //public $name = "Doggy";
    public function makeSound()
    {
        echo "Woof" . "<br>";
    }
}
// $cat = new Cat;
// // echo $cat->makeSound();
// echo $cat->name;

$dog = new Dog;
echo $dog->name . "<br>";
echo $dog->makeSound();

/** #191 Exception Handling try and catch and finally in OOP */
class CustumMessage extends \Exception
{
    public function errorMessage()
    {
        return 'I have Error In Line' . $this->getLine() . ' / In File' . $this->getFile();
    }
}
class User
{

    public function balance($balance)
    {
        if ($balance <= 200) {
            throw new CustumMessage("This User Not Have A balance", 201);
        }
        return "User Has Balance"."<br>";
    }
}

$user = new User;
try {
    // echo $user->balance(100);
    echo $user->balance(201);
} catch (CustumMessage $error) {
    echo '<h3>' . $error->errorMessage() . '<h3>';
    exit;
    // echo '<h3>' . $error->getCode() . '<h3>';
}finally{
    echo "The transaction is done";
}
