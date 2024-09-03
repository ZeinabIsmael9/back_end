<?php
$data = validation([
    'news_id' => 'required|integer|exists:news,id',
    'name' => 'required|string',
    'email' => 'required|email',
    'comment' => 'required', 
], [
    'name' => trans('main.name'),
    'email' => trans('main.email'),
    'comment' => trans('main.comment'),
    'news_id' => trans('main.news_id'),
],"api");


db_create('comment', $data);
echo response([
    "status"=> true,
    "message" => trans('main.comment_added'),
]);

// session_flash('old');
// session('success',trans('admin.added'));
