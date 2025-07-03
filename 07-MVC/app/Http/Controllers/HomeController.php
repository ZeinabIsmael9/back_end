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
        $users = User::paginate(1);
        // echo "getTotal : " . $paginate->getTotal() . '<br>';
        // echo "getCurrentPage : " . $paginate->getCurrentPage() . '<br>';
        // echo "getPerPage : " . $paginate->getPerPage() . '<br>';
        // echo "getTotalPages : " . $paginate->getTotalPages() . '<br>';
        // echo "  hasNextPage : ";
        // echo  $paginate->hasNextPage() ? "yes" : "no" . '<br>';
        // echo "  hasPreviousPage : ";
        // echo  $paginate->hasPreviousPage() ? "yes" : "no" . '<br>';

        // return User::where('name','LIKE','Admin')->count();
        // $users = User::take(1)->get()->toArray();
        // // var_dump($users);
        // foreach ($users as $user) {
        //     echo $user['name'] . '<br>';
        // }
        // include base_path('app/views/index.tpl.php');
        return view('index',['users'=>$users]);
    }

    public function data()
    {
         return view('data');
        // include base_path('app/views/data.tpl.php');
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
