<?php
view('admin.layouts.header', ['title' => trans('admin.books')]);

$books = db_find('book', request('id'));
redirect_if(empty($books), aurl('books'));
$categories = db_get('categories', '');
?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h2><?php echo trans('admin.books'); ?> - <?php echo trans('admin.edit'); ?></h2>
    <a class="btn btn-primary" href="<?php echo aurl('books'); ?>"><?php echo trans('admin.books'); ?></a>
</div>

<form method="post" action="<?php echo aurl('books/edit?id='.$books['id']); ?>" enctype="multipart/form-data">
    <input type="hidden" name="_method" value="put">
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="title"><?php echo trans('books.title'); ?></label>
                <input type="text" 
                       class="form-control <?php echo !empty(get_error('title')) ? 'is-invalid' : 'is-valid'; ?>" 
                       id="title" 
                       name="title" 
                       placeholder="<?php echo trans('books.title'); ?>" 
                       value="<?php echo htmlspecialchars($books['title']); ?>">
                <?php if (!empty(get_error('title'))): ?>
                    <div class="invalid-feedback"><?php echo get_error('title'); ?></div>
                <?php endif; ?>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="category_id"><?php echo trans('books.category_id'); ?></label>
                <select name="category_id" 
                        class="form-select <?php echo !empty(get_error('category_id')) ? 'is-invalid' : 'is-valid'; ?>">
                    <option disabled selected><?php echo trans('admin.choose'); ?></option>
                    <?php while($category = mysqli_fetch_assoc($categories['query'])): ?>
                        <option value="<?php echo htmlspecialchars($category['id']); ?>" 
                                <?php echo $books['category_id'] == $category['id'] ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($category['name']); ?>
                        </option>
                    <?php endwhile; ?>
                </select>
                <?php if (!empty(get_error('category_id'))): ?>
                    <div class="invalid-feedback"><?php echo get_error('category_id'); ?></div>
                <?php endif; ?>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="image"><?php echo trans('books.image'); ?></label>
                <input type="file" 
                       class="form-control <?php echo !empty(get_error('image')) ? 'is-invalid' : 'is-valid'; ?>" 
                       id="image" 
                       name="image">
                <?php if (!empty($books['image'])): ?>
                    <img src="<?php echo storage_url($books['image']); ?>" alt="Books Image" style="max-width: 100%; height: auto;">
                <?php endif; ?>
                <?php if (!empty(get_error('image'))): ?>
                    <div class="invalid-feedback"><?php echo get_error('image'); ?></div>
                <?php endif; ?>
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <label for="description"><?php echo trans('books.description'); ?></label>
                <textarea class="form-control <?php echo !empty(get_error('description')) ? 'is-invalid' : 'is-valid'; ?>" 
                          id="description" 
                          name="description" 
                          placeholder="<?php echo trans('books.description'); ?>"><?php echo htmlspecialchars($books['description']); ?></textarea>
                <?php if (!empty(get_error('description'))): ?>
                    <div class="invalid-feedback"><?php echo get_error('description'); ?></div>
                <?php endif; ?>
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <label for="content"><?php echo trans('books.content'); ?></label>
                <textarea class="form-control <?php echo !empty(get_error('content')) ? 'is-invalid' : 'is-valid'; ?>" 
                          id="content" 
                          name="content" 
                          placeholder="<?php echo trans('books.content'); ?>"><?php echo htmlspecialchars($books['content']); ?></textarea>
                <?php if (!empty(get_error('content'))): ?>
                    <div class="invalid-feedback"><?php echo get_error('content'); ?></div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <input type="submit" class="btn btn-success" value="<?php echo trans('admin.save'); ?>">
</form>

<script>
    ClassicEditor
        .create(document.querySelector('#content'), {
            language: '<?php echo session_has("locale") ? session("locale") : "en"; ?>',
        })
        .catch(error => {
            console.error(error);
        });
</script>

<?php view('admin.layouts.footer'); ?>
