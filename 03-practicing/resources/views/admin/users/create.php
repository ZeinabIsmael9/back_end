<?php
view('admin.layouts.header', ['title' => trans('admin.users') . ' - ' . trans('admin.create')]);
?>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h2>{{ trans('admin.users') }} - {{ trans('admin.create') }}</h2>
        <a class="btn btn-primary" href="{{ aurl('users') }}">{{ trans('admin.users') }}</a>
    </div>

    <form method="post" action="{{ aurl('users/create') }}" enctype="multipart/form-data">
        <input type="hidden" name="_method" value="post">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name">{{ trans('users.name') }}</label>
                    <input type="text" 
                           class="form-control <?php echo !empty(get_error('name')) ? 'is-invalid' : ''; ?>" 
                           id="name" 
                           placeholder="{{ trans('users.name') }}" 
                           name="name" 
                           value="{{ old('name') }}">
                    <?php if (!empty(get_error('name'))): ?>
                        <div class="invalid-feedback">{{ get_error('name') }}</div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="email">{{ trans('users.email') }}</label>
                    <input type="email" 
                           class="form-control <?php echo !empty(get_error('email')) ? 'is-invalid' : ''; ?>" 
                           id="email" 
                           placeholder="{{ trans('users.email') }}" 
                           name="email" 
                           value="{{ old('email') }}">
                    <?php if (!empty(get_error('email'))): ?>
                        <div class="invalid-feedback">{{ get_error('email') }}</div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="password">{{ trans('users.password') }}</label>
                    <input type="password" 
                           class="form-control <?php echo !empty(get_error('password')) ? 'is-invalid' : ''; ?>" 
                           id="password" 
                           placeholder="{{ trans('users.password') }}" 
                           name="password">
                    <?php if (!empty(get_error('password'))): ?>
                        <div class="invalid-feedback">{{ get_error('password') }}</div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="mobile">{{ trans('users.mobile') }}</label>
                    <input type="text" 
                           class="form-control <?php echo !empty(get_error('mobile')) ? 'is-invalid' : ''; ?>" 
                           id="mobile" 
                           placeholder="{{ trans('users.mobile') }}" 
                           name="mobile" 
                           value="{{ old('mobile') }}">
                    <?php if (!empty(get_error('mobile'))): ?>
                        <div class="invalid-feedback">{{ get_error('mobile') }}</div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="user_type">{{ trans('users.user_type') }}</label>
                    <select name="user_type" 
                            class="form-select <?php echo !empty(get_error('user_type')) ? 'is-invalid' : ''; ?>">
                        <option value="admin" {{ old('user_type') == 'admin' ? 'selected' : '' }}>{{ trans('users.admin') }}</option>
                        <option value="user" {{ old('user_type') == 'user' ? 'selected' : '' }}>{{ trans('users.user') }}</option>
                    </select>
                    <?php if (!empty(get_error('user_type'))): ?>
                        <div class="invalid-feedback">{{ get_error('user_type') }}</div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-12">
                <input type="submit" class="btn btn-success" value="{{ trans('admin.save') }}">
            </div>
        </div>
    </form>
<?php
view('admin.layouts.footer');
?>