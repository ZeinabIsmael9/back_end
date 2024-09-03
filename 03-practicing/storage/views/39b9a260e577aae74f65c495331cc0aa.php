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
    <h2><?php echo  trans('comment.comment')  ?> - <?php echo  trans('admin.show')  ?></h2>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="name"><?php echo  trans('comment.name')  ?></label>
                <?php echo  $comment['name'] ?? ''  ?>
            </div>
        </div>
        
        <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="email"><?php echo  trans('comment.email')  ?></label>
                <?php echo  $comment['email'] ?? ''  ?>
            </div>
        </div>
        
        <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="news"><?php echo  trans('comment.news')  ?></label>
                <?php echo  $comment['title'] ?? ''  ?>
                <!-- <a href="<?php echo  aurl('news/show?id='.$comment['news_id'])  ?>"><?php echo  $comment['news_id']  ?></a> -->
            </div>
        </div>
        <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="status"><?php echo  trans('comment.status')  ?></label>
                <?php echo  $comment['status'] ?? ''  ?>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="description"><?php echo  trans('cat.description')  ?></label>
                <?php echo  $comment['description'] ?? ''  ?>
            </div>
        </div>
    </div>

<?php
view('admin.layouts.footer');
?>