<?php
$data = validation([
    'title' => 'required|string',
    'category_id' => 'required',
    'image' => 'image', 
    'description' => '', 
    'content' => 'required', 
], [
    'title' => trans('books.title'),
    'image' => trans('books.image'),
    'description' => trans('books.description'),
    'category_id' => trans('books.category_id'),
    'content' => trans('books.content'),
]);

if (!empty($data['image']['tmp_name'])) {
    $file_info = file_ext($data['image']);
    $image_path = store_file($data['image'], 'books/' . $file_info['hash_name']);
    
    if ($image_path) {
        $data['image'] = $image_path; 
    } else {
        unset($data['image']);
    }
} else {
    unset($data['image']); 
}

$data['created_at'] = date('Y-m-d H:i:s');
$data['updated_at'] = date('Y-m-d H:i:s');

db_create('book', $data);
session_flash('old');
session('success', trans('admin.added'));
redirect(aurl('books'));
