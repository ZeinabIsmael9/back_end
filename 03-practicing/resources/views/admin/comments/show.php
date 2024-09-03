<?php
view('admin.layouts.header', ['title' => trans('comment.comment') . ' - ' . trans('admin.edit')]);
//$comment = db_find('comment', request('id'));

$comment = db_frist('comment', "
JOIN news ON comment.news_id = news.id
WHERE comment.id=".request('id'),
"news.title as title,
comment.id,
comment.name,
comment.email,
comment.status,
comment.comment,
comment.news_id"
);

redirect_if(empty($comment), aurl('comments'));

?>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h2>{{ trans('comment.comment') }} - {{ trans('admin.show') }}</h2>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="name">{{ trans('comment.name') }}</label>
                {{ $comment['name'] ?? '' }}
            </div>
        </div>
        
        <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="email">{{ trans('comment.email') }}</label>
                {{ $comment['email'] ?? '' }}
            </div>
        </div>
        
        <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="news">{{ trans('comment.news') }}</label>
                {{ $comment['title'] ?? '' }}
                <!-- <a href="{{ aurl('news/show?id='.$comment['news_id']) }}">{{ $comment['news_id'] }}</a> -->
            </div>
        </div>
        <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="status">{{ trans('comment.status') }}</label>
                {{ $comment['status'] ?? '' }}
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="description">{{ trans('cat.description') }}</label>
                {{ $comment['description'] ?? '' }}
            </div>
        </div>
    </div>

<?php
view('admin.layouts.footer');
?>