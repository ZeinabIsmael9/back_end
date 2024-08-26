<?php
$data = validation([
    'name' => 'required|string',
    'icon' => 'image',
    'description' => 'required', 
], [
    'name' => trans('cat.name'),
    'icon' => trans('cat.icon'),
    'description' => trans('cat.description'),
]);
if (!empty($data['icon']['tmp_name'])) {
    $category = db_find('categories', request('id'));
    redirect_if(empty($category), aurl('categories'));
    delete_file($category['icon']);
    
    $file_path = store_file($data['icon'], 'categories');
    if ($file_path !== false) {
        $data['icon'] = $file_path;
    } else {
        $data['icon'] = null;
    }

} else {
    unset($data['icon']);
}

//var_dump($data);
db_update('categories',$data,request('id'));
redirect(aurl('categories/edit?id='.request('id')));
