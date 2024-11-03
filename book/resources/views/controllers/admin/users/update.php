<?php
$data = validation([
    'name' => 'required|string',
    'email' => 'required|email|unique:user,email,' . request('id'),
    'password' => '',
    'mobile' => 'required|unique:user,mobile,' . request('id'),
    'user_type' => 'required|string|in:user,admin',
], [
    'name' => trans('users.name'),
    'email' => trans('users.email'),
    'password' => trans('users.password'),
    'mobile' => trans('users.mobile'),
    'user_type' => trans('users.user_type'),
]);

if (!empty($data['password'])) {
    $data['password'] = bcyrypt($data['password']);
} else {
    unset($data['password']);
}

db_update('user', $data, request('id'));
session_forget('old');
session('success',trans('admin.updated'));
redirect(aurl('users/edit?id=' . request('id')));

