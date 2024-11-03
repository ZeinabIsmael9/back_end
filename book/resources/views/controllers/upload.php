<?php

// var_dump(request('image'));
// store_file(request('image'),'images/img.png');

$data =validation([
    'email' => 'required|email',
    'mobile' => 'required|numeric',
    'address' => 'required|string',
], [
    'email' => trans('main.email'),
    'mobile' => trans('main.mobile'),
    'address' => trans('main.address'),
]/*,'api'*/);

// var_dump(any_errors('email'));
session_flash('old');
if(any_errors()!== null && count(any_errors())>0){
    redirect('/');
}

var_dump($data);