<?php
// Perform validation on email, password, and remember-me checkbox
$data = validation([
    'email' => 'required|email',
    'password' => 'required',
    'remember-me' => '', 
], [
    'email' => trans('admin.email'),
    'password' => trans('admin.password'),
]);

// Check if the input matches hardcoded admin credentials
if ($data['email'] === 'admin' && $data['password'] === 'admin') {
    // Set session data for admin and redirect to the dashboard
    session('admin', json_encode(['email' => 'admin', 'user_type' => 'admin']));
    redirect(ADMIN . '/dashboard');
    exit;
}

// Fetch user from database using provided email
$login = db_frist('user', "WHERE email = '".$data['email']."'");

if (empty($login) || !hash_check($data['password'], $login['password']) || $login['user_type'] != 'admin') {
    // If login fails, set an error message and redirect to login page
    session('error_login', trans('admin.login_failed'));
    redirect(ADMIN . '/login');
    exit;
}

// If login is successful and user is an admin, set session data and redirect to admin area
session('admin', json_encode($login));
redirect(ADMIN );
exit;


    // var_dump(bcyrypt($data ['password']));
    // var_dump($data);
