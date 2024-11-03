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

if (!empty($data['icon']['tmp_name'])) {
    $books = db_find('book', request('id'));
    redirect_if(empty($books), aurl('book'));
    delete_file($books['icon']);
    
    $file_path = store_file($data['icon'], 'book');
    if ($file_path !== false) {
        $data['icon'] = $file_path;
    } else {
        $data['icon'] = null;
    }

} else {
    unset($data['icon']);
}

//var_dump($data);
db_update('book',$data,request('id'));
session('success',trans('admin.updated'));
redirect(aurl('books/edit?id='.request('id')));
