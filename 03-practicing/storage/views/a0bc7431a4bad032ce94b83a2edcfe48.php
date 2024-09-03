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
        <h2><?php echo  trans('admin.news')  ?> - <?php echo  trans('admin.show')  ?> # <?php echo  $news['name'] ?? ''  ?></h2>
        <a class="btn btn-primary" href="<?php echo  aurl('news.create')  ?>"><?php echo  trans('admin.news')  ?></a>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="name"><?php echo  trans('news.title')  ?></label>
                <?php echo  $news['title'] ?? ''  ?>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="category_id"><?php echo  trans('news.category_id')  ?></label>
                
                <a href="<?php echo aurl('categories/show?id='.$new['category_id']) ?>"><?php echo  $news['category_name'] ?? ''  ?></a>
                </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="user_id"><?php echo  trans('news.user_id')  ?></label>
                
                <a href="<?php echo aurl('user/show?id='.$new['user_id']) ?>"><?php echo  $news['user_name'] ?? ''  ?></a>                           </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="image"><?php echo  trans('news.image')  ?></label>
                <?php echo  image(storage_url($news['image'] ?? ''))  ?>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="description"><?php echo  trans('news.description')  ?></label>
                <?php echo  $news['description'] ?? ''  ?>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="content"><?php echo  trans('news.content')  ?></label>
                <?php echo  $news['content'] ?? ''  ?>
            </div>
        </div>
    </div>
</div>
<?php
// Load the footer view
view('admin.layouts.footer');
?>
