

<?php
$data = validation([
    'title' => 'required|string',
    'category_id' => 'required',
    'image' => 'image',
    'description' => '', 
    'content' => 'required', 
], [
    'title' => trans('news.title'),
    'image' => trans('news.image'),
    'description' => trans('news.description'),
    'category_id' => trans('news.category_id'),
    'content' => trans('news.content'),
]);
//var_dump($data);
if (!empty($data['image']['tmp_name'])) {
    $news = db_find('news',request('id'));
    redirect_if(empty($news),aurl('news'));
    delete_file($news['image']); // حذف الصورة القديمة
    $file_info = file_ext($data['image']);
    $data['image'] = store_file($data['image'], 'news/' . $file_info['hash_name']);
} else {
    unset($data['image']); // إذا لم يتم تحميل صورة جديدة، احتفظ بالصورة القديمة
}


$data['user_id'] = auth()['id'];
$data['updated_at'] = date('Y-m-d H:i:s');
//var_dump($data);
db_update('news', $data, request('id'));
session_flash('old');
session('success',trans('admin.updated'));
redirect(aurl('news/edit?id='.request('id')));
