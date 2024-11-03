<?php 
// var_dump(request('id'));
$category = db_find('book', request('id'));
    redirect_if(empty($category), aurl('books'));
if(!empty($category['image'])){
    delete_file($category['image']);
}

db_delete('book', request('id'));
session('success',trans('admin.deleted'));
redirect(aurl('books'));
