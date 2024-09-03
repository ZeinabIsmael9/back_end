<?php
view('layout.header', ['title' => trans('main.home')]);

if (session_has('success')) {
    echo session_flash('success');
}

// set_locale('en');

// echo trans('main.home');
// echo "<br>";
// echo trans('main.add_user');
?>

<h1>Home Page</h1>


<form action="<?php echo url('upload'); ?>" method="post" enctype="multipart/form-data">

    <label>Email</label>
    <input type="text" name="email" value="<?php echo old('email');?>" class="form-control <?php echo !empty($email_valid) ? 'is-invalid' : 'is-valid'; ?>" />
    <div class="invalid-feedback">
        <?php echo $email_valid; ?>
    </div>
    <br>

    <label>Mobile</label>
    <input type="text" name="mobile" value="<?php echo old('mobile');?>" class="form-control <?php echo !empty($mobile_valid) ? 'is-invalid' : 'is-valid'; ?>" />
    <div class="invalid-feedback">
        <?php echo $mobile_valid; ?>
    </div>
    <br>

    <label>Address</label>
    <input type="text" name="address" value="<?php echo old('address');?>" class="form-control <?php echo !empty($address_valid) ? 'is-invalid' : 'is-valid'; ?>" />
    <div class="invalid-feedback">
        <?php echo $address_valid; ?>
    </div>
    <br>

    <input type="hidden" name="_method" value="post"/>
    <input type="submit" class="btn btn-success" value="Send"/>
</form>

<?php 
view('layout.footer'); 
?>
