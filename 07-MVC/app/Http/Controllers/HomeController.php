<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminates\Database\Model;
use Illuminates\Http\Request;
use Illuminates\Views\View;

class HomeController extends Controller
{
    public function index()
    {
        $user = User::find(1);
        // $user = User::where('id','=', 1)->first();
        return $user->email;
    }

    public function data()
    {
        // return view('data');
        include base_path('app/views/data.tpl.php');
    }

    public function data_post()
    {
        // $file = Request::file('file');
        // // $file->name(uniqid('', true) . rand(1, 100));
        // $file->store('my/images');
        // return Request::file('file')->store('data');
        return var_dump(request());
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

    public function api_any()
    {
        echo 'Welcome To api_any page!';
    }
}
