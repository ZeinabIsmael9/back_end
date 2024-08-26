
<?php
$data = validation([
    'email' => 'required|email',
    'password' => 'required',
    'remember-me' => '', 
], [
    'email' => trans('admin.email'),
    'password' => trans('admin.password'),
]);


$login = db_frist('user',"where email LIKE '%".$data['email']."%'");
var_dump($login);

if (empty($login) || !password_verify($data['password'], $login['password']) || $login['user_type'] != 'admin') {
    session('error_login', trans('admin.login_failed'));
    redirect(ADMIN . '/login');
} else {
    session('admin', json_encode($login));
    redirect(ADMIN);
}
//var_dump(bcyrypt($data ['password']));
//var_dump($data);
