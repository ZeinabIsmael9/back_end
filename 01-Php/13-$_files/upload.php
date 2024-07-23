<?php

if(isset($_FILES['my_file'])){
    echo "<pre>";
    // var_dump($_FILES['my_file']);
    if($_FILES['my_file']['error'] == UPLOAD_ERR_OK){
        $ext = explode('.' ,$_FILES['my_file']['name']);
        $new_name = time().'.'.end($ext);
    }
    //move_uploaded_file($_FILES['my_file']['tmp_name'],'uploaded/'.$_FILES['my_file']['name']);
    move_uploaded_file($_FILES['my_file']['tmp_name'],'uploaded/'.$new_name);
    echo "</pre>";
}
