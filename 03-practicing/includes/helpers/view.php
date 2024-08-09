<?php
if (!function_exists('view')) {
    function view($path , array $vars=null) {
        // $full_path = '';
        // $current_paths = explode('.', $path);
        
        // foreach ($current_paths as $current) {
        //     if (end($current_paths) != $current) {
        //         $full_path .= '/' . $current;
        //     }
        // }

        // echo 'my path is:'. config('view.path'); // test config('view.path')
        // echo '<br>'; //'this code add space line '
        // echo 'config view path:'. base_path('resources/views'); //   base_path('resources/views')
        // echo '<br>'; //'this code add space line '
        // example for clean code
        $file = config('view.path') .'/'.str_replace('.','/', $path) .'.php';
        if (file_exists($file)) {
            if(!is_null($vars)&& is_array($vars)){
                foreach($vars as $key=>$value){
                    ${$key} = $value;
                }
            }
            
            include $file;
            return true;
        } else {
            include config('view.path') . '/404.php';
            return false;
        }
    }
}

// view('layout.header');
// view('layout.footer');
