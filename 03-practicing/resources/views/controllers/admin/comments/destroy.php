<?php 
// var_dump(request('id'));
$comment = db_find('comment', request('id'));
redirect_if(empty($comment), aurl('comments'));

db_delete('comment', request('id'));
session('success',trans('admin.deleted'));
redirect(aurl('comments'));
