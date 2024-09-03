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
    <h2>{{ trans('comment.comment') }} - {{ trans('admin.edit') }}</h2>
    <a class="btn btn-primary" href="{{ aurl('comments.show') }}">{{ trans('comment.comment') }}</a>
</div>

<form method="post" action="{{ aurl('comments/edit?id='.$comment['id']) }}" enctype="multipart/form-data">
    <input type="hidden" name="_method" value="post">
    <input type="hidden" name="news_id" value="{{ $comment['news_id'] }}">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="name">{{ trans('cat.name') }}</label>
                <input type="text" 
                       class="form-control <?php echo !empty(get_error('name')) ? 'is-invalid' : ''; ?>" 
                       id="name" 
                       placeholder="{{ trans('cat.name') }}" 
                       name="name" 
                       value="{{ $comment['name'] }}">
                <?php if (!empty(get_error('name'))): ?>
                    <div class="invalid-feedback">{{ get_error('name') }}</div>
                <?php endif; ?>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="email">{{ trans('comment.email') }}</label>
                <input type="text" 
                       class="form-control <?php echo !empty(get_error('email')) ? 'is-invalid' : ''; ?>" 
                       id="email" 
                       placeholder="{{ trans('comment.email') }}" 
                       name="email" 
                       value="{{ $comment['email'] }}">
                <?php if (!empty(get_error('email'))): ?>
                    <div class="invalid-feedback">{{ get_error('email') }}</div>
                <?php endif; ?>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="news">{{ trans('comment.news') }}</label>
                <a href="{{ aurl('news/show?id='.$comment['news_id']) }}" target="_blank">{{ $comment['title'] }}</a>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="status">{{ trans('comment.status') }}</label>
                <select class="form-select <?php echo !empty(get_error('status')) ? 'is-invalid' : ''; ?>" 
                        id="status" 
                        name="status">
                    <option value="show" <?php echo $comment['status'] == 'show' ? 'selected' : ''; ?>>
                        {{ trans('comment.show') }}
                    </option>
                    <option value="hide" <?php echo $comment['status'] == 'hide' ? 'selected' : ''; ?>>
                        {{ trans('comment.hide') }}
                    </option>
                </select>
                <?php if (!empty(get_error('status'))): ?>
                    <div class="invalid-feedback">{{ get_error('status') }}</div>
                <?php endif; ?>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="comment">{{ trans('comment.comment') }}</label>
                <textarea class="form-control <?php echo !empty(get_error('comment')) ? 'is-invalid' : ''; ?>" 
                          id="comment" 
                          name="comment" 
                          placeholder="{{ trans('comment.comment') }}">{{ $comment['comment'] }}</textarea>
                <?php if (!empty(get_error('comment'))): ?>
                    <div class="invalid-feedback">{{ get_error('comment') }}</div>
                <?php endif; ?>
            </div>
            <input type="submit" class="btn btn-success" value="{{ trans('admin.save') }}">
        </div>
    </div>
</form>