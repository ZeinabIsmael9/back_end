<?php

namespace App\Http\Controllers;

use Illuminates\Http\Validations\Validation;

// use Illuminates\Views\View;

class HomeController extends Controller
{
    public function index()
    {
        $validation = Validation::make([
            'name' => $_GET['name'] ?? '', //inputs
            'info' => $_GET['info'] ?? [],
        ], [
            'name' => 'required|string', //rules[string] //'required|string',
            // 'info' => 'required|json',
            'info' => 'required|array',
            'info.0' => 'integer',
        ], [
            'name' => trans('main.name'),
            'info' => trans('main.info'),
            // 'info.*' => trans('main.info'),
            // 'info.0' => trans('main.info'),
        ]);
        return $validation;
        // $title = 'index page';
        // $content = 'Welcome To index page';
        // $name = 'zeinab';
        // return view('index', compact('title', 'content', 'name'));
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

    public function api_any()
    {
        echo 'Welcome To api_any page!';
    }
}
