<?php

namespace App\Http\Controllers;

use Illuminates\Http\Request;

// use Illuminates\Views\View;

class HomeController extends Controller
{
    public function index()
    {
        // $random = random_bytes(6);
        // $bin = bin2hex($random);
        // echo $bin;
        // exit;
        $validation = $this->validated([
            // 'email' => $_GET['email'] ?? '', //inputs
            'user_id' => $_GET['user_id'] ?? '',
            // 'info' => $_GET['info'] ?? [],
        ], [
            // 'email' => 'required|string|email',
            'user_id' => ['required', 'integer'],
            // 'name'=>'required|string|in:zeinab,ismael',//rules[string] //'required|string',
            // 'info' => 'required|json',
            // 'info' => 'required|array',
            // 'info.0' => 'integer',
        ], [
            // 'email' => trans('main.email'),
            'user_id' => trans('main.user_id'),
            // 'info' => trans('main.info'),
            // 'info.*' => trans('main.info'),
            // 'info.0' => trans('main.info'),
        ]);

        echo "<pre>";
        return var_dump($validation->failed());
        // $title = 'index page';
        // $content = 'Welcome To index page';
        // $name = 'zeinab';
        // return view('index', compact('title', 'content', 'name'));
        // echo 'Welcome To index page!';
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
        return var_dump( request());
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
