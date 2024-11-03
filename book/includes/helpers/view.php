<?php

if (!function_exists('view')) {
    function view(string $path, array $vars = null) {
        $file = config('view.path') . '/' . str_replace('.', '/', $path) . '.php';
        if (file_exists($file)) {
            if(!is_null($vars) && is_array($vars)){
            foreach($vars as $key=>$value){
                ${$key} = $value;
            }
        }
            include($file);
        } else {
            include config('view.path') . '/404.php';
        }
    }
}



/* 
if (!function_exists('view_engine')) {
    function view_engine(string $view, array $vars=null) {
        if(!is_null($vars)&& is_array($vars)){
            foreach($vars as $key=>$value){
                ${$key} = $value;
            }
        }
        
        // Split the view file path to extract the file name
        // $file_path = explode('/', $view);
        // $file_name = end($file_path);
        $file_hash_name = md5($view);
        $save_to_storage = base_path('storage/views/' . $file_hash_name.'.php');
        
        //if(!file_exists($save_to_storage)){
        // Read the contents of the view file
        $file = file_get_contents($view);

        // Replace {{ ... }} with PHP echo statements
        $file = str_replace('{{', '<?php echo ', $file);
        $file = str_replace('}}', ' ?>', $file);

        // Replace @php and @endphp with opening and closing PHP tags
        $file = str_replace('@php', '<?php ', $file);
        $file = str_replace('@endphp', ' ?>', $file);

        // Replace @if(...) with PHP if statement
        $file = preg_replace('/@if\((.*?)\)+/i', '<?php if($1)): ?>', $file);
            $file = preg_replace('/@elseif\((.*?)\)+/i', '<?php elseif($1)): ?>', $file);
                $file = preg_replace('/@else/i', '<?php else: ?>', $file);
                    $file = preg_replace('/@endif/i', '<?php endif; ?>', $file);

        // Replace @foreach(...) as ... with PHP foreach statement
        $file = preg_replace('/@foreach\((.*?) as (.*?)\)+/i', '<?php foreach($1 as $2): ?>', $file);
        $file = preg_replace('/@endforeach/i', '<?php endforeach ?>', $file);

        // Save the processed file to the storage directory
        file_put_contents($save_to_storage, $file);

       // }
        // Include the processed file to execute it
        include $save_to_storage;
    }
}

*/
// view('layout.header');
// view('layout.footer');
