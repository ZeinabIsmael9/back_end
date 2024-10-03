<?php

use App\Controllers\UsersContoller;

    /** Single Responsibility Principle  */
class User
{
    public function __construct(private $name)
    {
        
    }
    public function getName(){
        return $this->name;
    }
}


class UsersController
{
    public function create(User $user){
        return $user->getName().PHP_EOL;
    }
}

$users = new UsersController;
$user = new User('Zeinab');
echo $users->create($user);