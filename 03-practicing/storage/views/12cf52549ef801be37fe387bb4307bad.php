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
    <h2><?php echo  trans('comment.comment')  ?> - <?php echo  trans('admin.edit')  ?></h2>
    <a class="btn btn-primary" href="<?php echo  aurl('comments.show')  ?>"><?php echo  trans('comment.comment')  ?></a>
</div>

<form method="post" action="<?php echo  aurl('comments/edit?id='.$comment['id'])  ?>" enctype="multipart/form-data">
    <input type="hidden" name="_method" value="post">
    <input type="hidden" name="news_id" value="<?php echo  $comment['news_id']  ?>">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="name"><?php echo  trans('cat.name')  ?></label>
                <input type="text" 
                       class="form-control <?php echo !empty(get_error('name')) ? 'is-invalid' : ''; ?>" 
                       id="name" 
                       placeholder="<?php echo  trans('cat.name')  ?>" 
                       name="name" 
                       value="<?php echo  $comment['name']  ?>">
                <?php if (!empty(get_error('name'))): ?>
                    <div class="invalid-feedback"><?php echo  get_error('name')  ?></div>
                <?php endif; ?>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="email"><?php echo  trans('comment.email')  ?></label>
                <input type="text" 
                       class="form-control <?php echo !empty(get_error('email')) ? 'is-invalid' : ''; ?>" 
                       id="email" 
                       placeholder="<?php echo  trans('comment.email')  ?>" 
                       name="email" 
                       value="<?php echo  $comment['email']  ?>">
                <?php if (!empty(get_error('email'))): ?>
                    <div class="invalid-feedback"><?php echo  get_error('email')  ?></div>
                <?php endif; ?>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="news"><?php echo  trans('comment.news')  ?></label>
                <a href="<?php echo  aurl('news/show?id='.$comment['news_id'])  ?>" target="_blank"><?php echo  $comment['title']  ?></a>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="status"><?php echo  trans('comment.status')  ?></label>
                <select class="form-select <?php echo !empty(get_error('status')) ? 'is-invalid' : ''; ?>" 
                        id="status" 
                        name="status">
                    <option value="show" <?php echo $comment['status'] == 'show' ? 'selected' : ''; ?>>
                        <?php echo  trans('comment.show')  ?>
                    </option>
                    <option value="hide" <?php echo $comment['status'] == 'hide' ? 'selected' : ''; ?>>
                        <?php echo  trans('comment.hide')  ?>
                    </option>
                </select>
                <?php if (!empty(get_error('status'))): ?>
                    <div class="invalid-feedback"><?php echo  get_error('status')  ?></div>
                <?php endif; ?>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="comment"><?php echo  trans('comment.comment')  ?></label>
                <textarea class="form-control <?php echo !empty(get_error('comment')) ? 'is-invalid' : ''; ?>" 
                          id="comment" 
                          name="comment" 
                          placeholder="<?php echo  trans('comment.comment')  ?>"><?php echo  $comment['comment']  ?></textarea>
                <?php if (!empty(get_error('comment'))): ?>
                    <div class="invalid-feedback"><?php echo  get_error('comment')  ?></div>
                <?php endif; ?>
            </div>
            <input type="submit" class="btn btn-success" value="<?php echo  trans('admin.save')  ?>">
        </div>
    </div>
</form>