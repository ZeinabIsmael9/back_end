<?php

namespace App\Http\Controllers;

// use Illuminates\Views\View;

class HomeController
{
    public function index()
    {
        $title = 'index page';
        $content = 'Welcome To index page';
        $name = 'zeinab';
        return view('index', compact('title', 'content', 'name'));
        // echo 'Welcome To index page!';
    }

    public function about()
    {
        echo 'Welcome To about page!';
    }

    public function article($id)
    {
        echo 'Welcome To article page where id = ' . $id;
    }

    public function contact()
    {
        echo 'Welcome To contact page!';
    }
}
