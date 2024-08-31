<?php
view('admin.layouts.header', ['title' => trans('admin.categories')]);
?>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h2>{{ trans('admin.categories') }} - {{ trans('admin.add') }}</h2>
        <a class="btn btn-primary" href="{{ aurl('categories.create') }}">{{ trans('admin.categories') }}</a>
    </div>

    <form method="post" action="{{ aurl('categories/create') }}" enctype="multipart/form-data">
        <input type="hidden" name="_method" value="post">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name">{{ trans('cat.name') }}</label>
                    <input type="text" 
                           class="form-control <?php echo !empty(get_error('name')) ? 'is-invalid' : ''; ?>" 
                           id="name" 
                           placeholder="{{ trans('cat.name') }}" 
                           name="name" 
                           value="{{ old('name') }}">
                    <?php if (!empty(get_error('name'))): ?>
                        <div class="invalid-feedback">{{ get_error('name') }}</div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="icon">{{ trans('cat.icon') }}</label>
                    <input type="file" 
                           class="form-control <?php echo !empty(get_error('icon')) ? 'is-invalid' : ''; ?>" 
                           id="icon" 
                           name="icon" 
                           placeholder="{{ trans('cat.icon') }}">
                    <?php if (!empty(get_error('icon'))): ?>
                        <div class="invalid-feedback">{{ get_error('icon') }}</div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="description">{{ trans('cat.description') }}</label>
                    <textarea class="form-control <?php echo !empty(get_error('description')) ? 'is-invalid' : ''; ?>" 
                              id="description" 
                              name="description" 
                              placeholder="{{ trans('cat.description') }}">{{ old('description') }}</textarea>
                    <?php if (!empty(get_error('description'))): ?>
                        <div class="invalid-feedback">{{ get_error('description') }}</div>
                    <?php endif; ?>
                </div>
                <input type="submit" class="btn btn-success" value="{{ trans('admin.add') }}">
            </div>
        </div>
    </form>
<?php
view('admin.layouts.footer');
?>
