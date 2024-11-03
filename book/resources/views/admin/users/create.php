<?php
view('admin.layouts.header', ['title' => trans('admin.users') . ' - ' . trans('admin.create')]);
?>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h2><?php echo  trans('admin.users')  ?> - <?php echo  trans('admin.create')  ?></h2>
        <a class="btn btn-primary" href="<?php echo  aurl('users')  ?>"><?php echo  trans('admin.users')  ?></a>
    </div>

    <form method="post" action="<?php echo  aurl('users/create')  ?>" enctype="multipart/form-data">
        <input type="hidden" name="_method" value="post">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name"><?php echo  trans('users.name')  ?></label>
                    <input type="text" 
                           class="form-control <?php echo !empty(get_error('name')) ? 'is-invalid' : ''; ?>" 
                           id="name" 
                           placeholder="<?php echo  trans('users.name')  ?>" 
                           name="name" 
                           value="<?php echo  old('name')  ?>">
                    <?php if (!empty(get_error('name'))): ?>
                        <div class="invalid-feedback"><?php echo  get_error('name')  ?></div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="email"><?php echo  trans('users.email')  ?></label>
                    <input type="email" 
                           class="form-control <?php echo !empty(get_error('email')) ? 'is-invalid' : ''; ?>" 
                           id="email" 
                           placeholder="<?php echo  trans('users.email')  ?>" 
                           name="email" 
                           value="<?php echo  old('email')  ?>">
                    <?php if (!empty(get_error('email'))): ?>
                        <div class="invalid-feedback"><?php echo  get_error('email')  ?></div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="password"><?php echo  trans('users.password')  ?></label>
                    <input type="password" 
                           class="form-control <?php echo !empty(get_error('password')) ? 'is-invalid' : ''; ?>" 
                           id="password" 
                           placeholder="<?php echo  trans('users.password')  ?>" 
                           name="password">
                    <?php if (!empty(get_error('password'))): ?>
                        <div class="invalid-feedback"><?php echo  get_error('password')  ?></div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="mobile"><?php echo  trans('users.mobile')  ?></label>
                    <input type="text" 
                           class="form-control <?php echo !empty(get_error('mobile')) ? 'is-invalid' : ''; ?>" 
                           id="mobile" 
                           placeholder="<?php echo  trans('users.mobile')  ?>" 
                           name="mobile" 
                           value="<?php echo  old('mobile')  ?>">
                    <?php if (!empty(get_error('mobile'))): ?>
                        <div class="invalid-feedback"><?php echo  get_error('mobile')  ?></div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="user_type"><?php echo  trans('users.user_type')  ?></label>
                    <select name="user_type" 
                            class="form-select <?php echo !empty(get_error('user_type')) ? 'is-invalid' : ''; ?>">
                        <option value="admin" <?php echo  old('user_type') == 'admin' ? 'selected' : ''  ?>><?php echo  trans('users.admin')  ?></option>
                        <option value="user" <?php echo  old('user_type') == 'user' ? 'selected' : ''  ?>><?php echo  trans('users.user')  ?></option>
                    </select>
                    <?php if (!empty(get_error('user_type'))): ?>
                        <div class="invalid-feedback"><?php echo  get_error('user_type')  ?></div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-12">
                <input type="submit" class="btn btn-success" value="<?php echo  trans('admin.save')  ?>">
            </div>
        </div>
    </form>
<?php
view('admin.layouts.footer');
?>
