<?php
namespace App\HTTP\Controllers;

class HomeController
{
    public function index()
    {
        echo 'Welcome To index page!';
    }
    public function about()
    {
        echo 'Welcome To about page!';
    }
    public function article($id)
    {
        echo 'Welcome To article page where id ='.$id;
    }
}