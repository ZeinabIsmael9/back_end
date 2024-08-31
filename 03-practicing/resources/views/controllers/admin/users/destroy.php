<?php 
// var_dump(request('id'));
$user = db_find('user', request('id'));
    redirect_if(empty($user), aurl('users'));

db_delete('user', request('id'));
session('success',trans('admin.deleted'));
redirect(aurl('users'));
