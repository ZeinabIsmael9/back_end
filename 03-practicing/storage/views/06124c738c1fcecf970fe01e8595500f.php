<?php
$data = validation([
    'name' => 'required|string',
    'icon' => 'required|image',
    'description' => 'required', 
], [
    'name' => trans('cat.name'),
    'icon' => trans('cat.icon'),
    'description' => trans('cat.description'),
]);

$file_info = file_ext($data['icon']);
$data['icon'] = store_file($data['icon'], 'categories/' . $file_info['hash_name']);
//var_dump($data);
db_create('categories', $data);
session_flash('old');
session('success',trans('admin.added'));
redirect(aurl('categories'));
