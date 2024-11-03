<?php
$data = validation([
    'name' => 'required|string',
    'email' => 'required|email|unique:user',
    'password' => 'required',
    'mobile' => 'required|unique:user',
    'user_type' => 'required|string|in:user,admin',
], [
    'name' => trans('users.name'),
    'email' => trans('users.email'),
    'password' => trans('users.password'),
    'mobile' => trans('users.mobile'),
    'user_type' => trans('users.user_type'),
]);

$data['password'] = bcyrypt($data['password']);
db_create('user', $data);
session_forget('old');
session('success',trans('admin.added'));
redirect(aurl('users'));
