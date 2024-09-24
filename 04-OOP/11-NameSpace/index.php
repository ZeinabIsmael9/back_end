<?php
namespace App;
include "Model/User.php";
include "Controller/Users.php";
 include "Model/interface.php";
// $user = new \App\Model\User;
// $users = new \App\Controller\User;
// echo $user->name();
// echo "<br>";
// echo $users->name();


/** #184 rename everything in namespace OOP */

use \App\Model\UserInfo as MyUser;           // Alias for the class
 use \App\Model\User as InterfaceUserInfo; // Alias for the interface
use \App\Controller\UserInfo as TraitUserInfo; // Alias for the trait

class User extends MyUser /*implements InterfaceUserInfo */{
    use TraitUserInfo;  // Using the trait
}

$user = new User;
echo $user->age(); 
