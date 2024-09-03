<?php
$data = validation([
    'news_id' => 'required|integer|exists:news,id',
    'name' => 'required|string',
    'email' => 'required|email',
    'comment' => 'required', 
    'status'=>'required|in:show,hide',
], [
    'name' => trans('main.name'),
    'email' => trans('main.email'),
    'comment' => trans('main.comment'),
    'news_id' => trans('main.news_id'),
    'status' => trans('main.status'),
]);

    $comment = db_find('comment', request('id'));
    redirect_if(empty($comment), aurl('comments'));

//var_dump($data);
db_update('comment',$data,request('id'));
session('success',trans('admin.updated'));
redirect(aurl('comments/edit?id='.request('id')));

