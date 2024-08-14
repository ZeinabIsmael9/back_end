<?php view('layout.header',['title'=>trans('main.home')]);

    // if(session_has('success')){
    //     echo session_flash('success');
    // }
    // set_locale('en');
    // echo trans('main.home');
    // echo"<br>";
    // echo trans('main.add_user');

?>
<h1>Home Page</h1>
<!-- <form action="
 // echo url('/back_end/03-practicing/users') ?>" method="post">
    <input type="text" name="username"/>
    <input type="hidden" name="password" value="post"/>
    <input type="submit" value="Send"/>
</form> -->
<form action="<?php echo url('/upload'); ?>" method="post" enctype="multipart/form-data">
    <input type="file" name="image" class="form-control"/>
    <input type="hidden" name="_gmethod" value="post"/>
    <input type="submit" class="btn btn-success" value="Send"/>
</form>
<?php view('layout.footer'); ?>
