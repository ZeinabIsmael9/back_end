<?php

view('admin.layouts.header', ['title' => trans('admin.users') . '-' . trans('admin.show')]);

$user = db_find('user', request('id'));
redirect_if(empty($user), aurl('users'));

?>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h2><?php echo  trans('admin.users')  ?> - <?php echo  trans('admin.show')  ?> # <?php echo  $user['name'] ?? ''  ?></h2>
        <a class="btn btn-primary" href="<?php echo  aurl('users.create')  ?>"><?php echo  trans('admin.users')  ?></a>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="name"><?php echo  trans('users.name')  ?></label>
                <?php echo  $user['name'] ?? ''  ?>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="email"><?php echo  trans('users.email')  ?></label>
                <?php echo  $user['email'] ?? ''  ?>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="mobile"><?php echo  trans('users.mobile')  ?></label>
                <?php echo  $user['mobile'] ?? ''  ?>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="user_type"><?php echo  trans('users.user_type')  ?></label>
                <?php echo  trans('users.'.$user['user_type'] ?? '')  ?>
            </div>
        </div>
    </div>

<?php
view('admin.layouts.footer');
?>