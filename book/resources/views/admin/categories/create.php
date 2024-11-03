<?php
view('admin.layouts.header', ['title' => trans('admin.categories')]);
?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h2><?php echo trans('admin.categories'); ?> - <?php echo trans('admin.add'); ?></h2>
    <a class="btn btn-primary" href="<?php echo aurl('categories/create'); ?>"><?php echo trans('admin.categories'); ?></a>
</div>
<?php if (any_errors()) : ?>
    <div class="alert alert-danger">
        <ol>
            <?php foreach (all_errors() as $error) : ?>
                <li><?php echo $error; ?></li>
            <?php endforeach; ?>
        </ol>
    </div>
<?php endif; ?>

<form method="post" action="<?php echo aurl('categories/create'); ?>" enctype="multipart/form-data">
    <input type="hidden" name="_method" value="post">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="name"><?php echo trans('cat.name'); ?></label>
                <input type="text"
                    class="form-control <?php echo !empty(get_error('name')) ? 'is-invalid' : ''; ?>"
                    id="name"
                    placeholder="<?php echo trans('cat.name'); ?>"
                    name="name"
                    value="<?php echo old('name'); ?>">
                <?php if (!empty(get_error('name'))) : ?>
                    <div class="invalid-feedback"><?php echo get_error('name'); ?></div>
                <?php endif; ?>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="icon"><?php echo trans('cat.icon'); ?></label>
                <input type="file"
                    class="form-control <?php echo !empty(get_error('icon')) ? 'is-invalid' : ''; ?>"
                    id="icon"
                    name="icon">
                <?php if (!empty(get_error('icon'))) : ?>
                    <div class="invalid-feedback"><?php echo get_error('icon'); ?></div>
                <?php endif; ?>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="description"><?php echo trans('cat.description'); ?></label>
                <textarea class="form-control <?php echo !empty(get_error('description')) ? 'is-invalid' : ''; ?>"
                    id="description"
                    name="description"><?php echo old('description'); ?></textarea>
                <?php if (!empty(get_error('description'))) : ?>
                    <div class="invalid-feedback"><?php echo get_error('description'); ?></div>
                <?php endif; ?>
            </div>
            <input type="submit" class="btn btn-success" value="<?php echo trans('admin.add'); ?>">
        </div>
    </div>
</form>
<?php
view('admin.layouts.footer');
?>
