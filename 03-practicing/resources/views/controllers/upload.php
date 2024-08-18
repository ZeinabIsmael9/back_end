<?php

//store_file(request('image'), 'category/1/file.plist');
//E:\xampp\htdocs\back_end\03-practicing\public\stroage\images\img.png
//store_file(request('image'), 'images/img.png');
//var_dump($_FILES['image']['tmp_name']);



$data = validation([
    'email' => 'required|email',
    'mobile' => 'required|numeric',
    'address' => 'required|string',
], [
    'email' => trans('main.email'),
    'mobile' => trans('main.mobile'),
    'address' => trans('main.address'),
]/*,'api'*/);
// echo "<pre>";
// var_dump(any_errors('email'));
// //var_dump(any_errors('mobile'));
// echo "</pre>";
var_dump($data);
session_flash('old');