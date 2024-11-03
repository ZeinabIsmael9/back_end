<?php
view('admin.layouts.header', ['title' => trans('admin.book') . ' - ' . trans('admin.show')]);

$books = db_frist('book', "
JOIN categories ON book.category_id = categories.id 
WHERE book.id = " . request('id'), "
book.title,
book.content,
book.category_id,
book.image,
book.description,
book.id,
categories.name AS category_name");

redirect_if(empty($books), aurl('book'));

?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h2><?php echo trans('admin.book') ?> - <?php echo trans('admin.show') ?> # <?php echo htmlspecialchars($books['title'] ?? '') ?></h2>
    <a class="btn btn-primary" href="<?php echo aurl('book.create') ?>"><?php echo trans('admin.book') ?></a>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="name"><?php echo trans('book.title') ?></label>
            <p><?php echo htmlspecialchars($books['title'] ?? '') ?></p>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="category_id"><?php echo trans('book.category_id') ?></label>
            <a href="<?php echo aurl('categories/show?id=' . $books['category_id']) ?>"><?php echo htmlspecialchars($books['category_name'] ?? '') ?></a>
        </div>
    </div>
    
    <div class="col-md-6">
        <div class="form-group">
            <label for="image"><?php echo trans('book.image') ?></label>
            <img src="<?php echo storage_url($books['image'] ?? '') ?>" alt="Book Image" style="max-width: 100%; height: auto;">
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label for="description"><?php echo trans('book.description') ?></label>
            <p><?php echo htmlspecialchars($books['description'] ?? '') ?></p>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label for="content"><?php echo trans('book.content') ?></label>
            <p><?php echo htmlspecialchars($books['content'] ?? '') ?></p>
        </div>
    </div>
</div>

<?php
// Load the footer view
view('admin.layouts.footer');
?>
