
<?php
view('layout.header', ['title' => trans('main.home')]);

// Uncomment the following lines if needed
// if(session_has('success')){
//     echo session_flash('success');
// }
// set_locale('en');
// echo trans('main.home');
// echo "<br>";
// echo trans('main.add_user');

?>

<h1>Home Page</h1>

<!-- Uncomment the following form if needed
<form action="<?php echo url('/back_end/03-practicing/users') ?>" method="post">
    <input type="text" name="username"/>
    <input type="hidden" name="password" value="post"/>
    <input type="submit" value="Send"/>
</form> -->

<!-- Uncomment the following link if needed
<a href="<?php echo url('storage/images/img.png') ?>">
    Download File
</a> -->

<?php if(any_errors()): ?>
<div class="alert alert-danger">
    <ol>
        <?php foreach(all_errors() as $error): ?>
            <li><?php echo $error; ?></li>
        <?php endforeach ?>
    </ol>
</div>
<?php endif; ?>

<?php 
$email_valid = get_error('email');
$mobile_valid = get_error('mobile');
$address_valid = get_error('address');
end_errors();
?>

<!-- <?php echo  'welcome to view engine' ?> <br>
<?php echo  url('upload') ?> -->

<form action="<?php echo url('upload'); ?>" method="post" enctype="multipart/form-data">
    <!-- <input type="file" name="image" class="form-control"/> -->

    <!-- Email Field -->
    <label>Email</label>
    <input type="text" name="email" value="<?php echo old('email');?>" class="form-control <?php echo !empty(get_error('email')) ? 'is-invalid' : 'is-valid'; ?>" />
    <div class="invalid-feedback">
        <?php echo get_error('email'); ?>
    </div>
    <br>

    <!-- Mobile Field -->
    <label>Mobile</label>
    <input type="text" name="mobile" value="<?php echo old('mobile');?>" class="form-control <?php echo !empty(get_error('mobile')) ? 'is-invalid' : 'is-valid'; ?>" />
    <div class="invalid-feedback">
        <?php echo get_error('mobile'); ?>
    </div>
    <br>

    <!-- Address Field -->
    <label>Address</label>
    <input type="text" name="address" value="<?php echo old('address');?>" class="form-control <?php echo !empty(get_error('address')) ? 'is-invalid' : 'is-valid'; ?>" />
    <div class="invalid-feedback">
        <?php echo get_error('address'); ?>
    </div>
    <br>

    <input type="hidden" name="_method" value="post"/>
    <input type="submit" class="btn btn-success" value="Send"/>
</form>

<?php view('layout.footer'); ?>