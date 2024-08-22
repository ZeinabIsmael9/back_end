<?php
// تضمين رأس الصفحة مع عنوان مأخوذ من ملف الترجمة
view('layout.header', ['title' => trans('main.home')]);

// إذا كانت هناك رسالة نجاح في الجلسة، عرضها
if (session_has('success')) {
    echo session_flash('success');
}

// تعيين اللغة إلى الإنجليزية
// set_locale('en');

// عرض بعض الترجمة كأمثلة
// echo trans('main.home');
// echo "<br>";
// echo trans('main.add_user');
?>

<h1>Home Page</h1>

<!-- إذا كانت هناك أي أخطاء، عرضها داخل قائمة -->
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
// الحصول على الأخطاء المتعلقة بكل حقل
$email_valid = get_error('email');
$mobile_valid = get_error('mobile');
$address_valid = get_error('address');

// إنهاء جلسة الأخطاء
end_errors();
 ?>

<form action="<?php echo url('upload'); ?>" method="post" enctype="multipart/form-data">

    <!-- حقل البريد الإلكتروني -->
    <label>Email</label>
    <input type="text" name="email" value="<?php echo old('email');?>" class="form-control <?php echo !empty($email_valid) ? 'is-invalid' : 'is-valid'; ?>" />
    <div class="invalid-feedback">
        <?php echo $email_valid; ?>
    </div>
    <br>

    <!-- حقل الهاتف -->
    <label>Mobile</label>
    <input type="text" name="mobile" value="<?php echo old('mobile');?>" class="form-control <?php echo !empty($mobile_valid) ? 'is-invalid' : 'is-valid'; ?>" />
    <div class="invalid-feedback">
        <?php echo $mobile_valid; ?>
    </div>
    <br>

    <!-- حقل العنوان -->
    <label>Address</label>
    <input type="text" name="address" value="<?php echo old('address');?>" class="form-control <?php echo !empty($address_valid) ? 'is-invalid' : 'is-valid'; ?>" />
    <div class="invalid-feedback">
        <?php echo $address_valid; ?>
    </div>
    <br>

    <!-- زر الإرسال -->
    <input type="hidden" name="_method" value="post"/>
    <input type="submit" class="btn btn-success" value="Send"/>
</form>

<?php 
// تضمين تذييل الصفحة
view('layout.footer'); 
?>
