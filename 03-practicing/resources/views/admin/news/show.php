<?php
view('admin.layouts.header', ['title' => trans('admin.news') . '-' . trans('admin.show')]);

$news = db_frist('news', "
JOIN categories on news.category_id = categories.id
JOIN user on news.user_id = user.id
where news.id=".request('id'),"
news.title,
news.content,
news.user_id,
news.category_id,
news.image,
news.description,
news.id,
user.name as user_name ,
categories.name as category_name");

redirect_if(empty($news), aurl('news'));

?>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h2>{{ trans('admin.news') }} - {{ trans('admin.show') }} # {{ $news['name'] ?? '' }}</h2>
        <a class="btn btn-primary" href="{{ aurl('news.create') }}">{{ trans('admin.news') }}</a>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="name">{{ trans('news.title') }}</label>
                {{ $news['title'] ?? '' }}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="category_id">{{ trans('news.category_id') }}</label>
                
                <a href="{{aurl('categories/show?id='.$new['category_id'])}}">{{ $news['category_name'] ?? '' }}</a>
                </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="user_id">{{ trans('news.user_id') }}</label>
                
                <a href="{{aurl('user/show?id='.$new['user_id'])}}">{{ $news['user_name'] ?? '' }}</a>                           </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="image">{{ trans('news.image') }}</label>
                {{ image(storage_url($news['image'] ?? '')) }}
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="description">{{ trans('news.description') }}</label>
                {{ $news['description'] ?? '' }}
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="content">{{ trans('news.content') }}</label>
                {{ $news['content'] ?? '' }}
            </div>
        </div>
    </div>
</div>
<?php
// Load the footer view
view('admin.layouts.footer');
?>
