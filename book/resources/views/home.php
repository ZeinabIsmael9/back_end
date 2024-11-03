

<?php
view('layout.header', ['title' => trans('main.home')]);

if (session_has('success')) {
    echo session_flash('success');
}
?>

<h1>Home File</h1>
<?php if (any_errors()): ?>
    <div class="alert alert-danger">
        <ol>
            <?php foreach (all_errors() as $error): ?>
                <li><?php echo $error; ?></li>
            <?php endforeach; ?>
        </ol>
    </div>
<?php endif; ?>
<?php
$name_valid = get_error('name');
$email_valid = get_error('email');
$mobile_valid = get_error('mobile');
$address_valid = get_error('address');
session_flash('errors');
?>

<form action="<?php echo url('upload'); ?>" method="post" enctype="multipart/form-data">

    <label>Email</label>
    <input type="text" name="email" value="<?php echo old('email'); ?>" class="form-control <?php echo !empty($email_valid) ? 'is-invalid' : ''; ?>" />
    <?php if ($email_valid): ?>
        <div class="invalid-feedback">
            <?php echo $email_valid; ?>
        </div>
    <?php endif; ?>
    <br>

    <label>Mobile</label>
    <input type="text" name="mobile" value="<?php echo old('mobile'); ?>" class="form-control <?php echo !empty($mobile_valid) ? 'is-invalid' : ''; ?>" />
    <?php if ($mobile_valid): ?>
        <div class="invalid-feedback">
            <?php echo $mobile_valid; ?>
        </div>
    <?php endif; ?>
    <br>

    <label>Address</label>
    <input type="text" name="address" value="<?php echo old('address'); ?>" class="form-control <?php echo !empty($address_valid) ? 'is-invalid' : ''; ?>" />
    <?php if ($address_valid): ?>
        <div class="invalid-feedback">
            <?php echo $address_valid; ?>
        </div>
    <?php endif; ?>
    <br>

    <input type="hidden" name="_method" value="post" />
    <input type="submit" class="btn btn-success" value="Send" />
</form>

<?php 
view('layout.footer'); 
end_errors(); 
?>
