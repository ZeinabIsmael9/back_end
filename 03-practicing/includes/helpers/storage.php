
<?php

if (!function_exists('storage')) {
    function storage($path)
    {
        // Implementation of storage function
        //var_dump($path);
        if (file_exists($path)) {
            header('Content-Description: file from server');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename=' . basename($path));
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length:' . filesize($path));
            readfile($path);
        }
        exit;
    }
}

if (!function_exists('delete_file')) {
    function delete_file($path)
    {
        if (file_exists($path)) {
            return unlink($path);
        }
    }
}


if (!function_exists('remove_folder')) {
    function remove_folder($path)
    {
        if (is_dir($path)) {
            return rmdir($path);
        }
    }
}


if (!function_exists('store_file')) {
    function store_file(array $from, string $to): bool|string
    {
        // Check if the temporary file name is set
        if (isset($from['tmp_name']) && !empty($from['tmp_name'])) {
            $to_path = '/' . ltrim($to, '/');
            $path = config('files.storage_files_path') . $to_path;

            $ex_path = explode('/', $path);
            $end_file = end($ex_path);
            $check_path = str_replace($end_file, '', $path);

            // Check if the directory needs to be created
            if (!empty($check_path) && !is_dir($check_path)) {
                mkdir($check_path, 0777, true);
            }

            // Move the uploaded file to the specified path
            if (move_uploaded_file($from['tmp_name'], $path)) {
                return $to;
            }
        }
        return false;
    }
}




if (!function_exists('file-ext')) {
    function file_ext(array $file_name): array
    {
        if (!empty($file_name['name'])) {
            $fext = explode('.', $file_name['name']);
            $file_ext = end($fext);
            $hash_name = md5(10) .rand(000,999). '.' . $file_ext;
            return [
                'name' => $file_name,
                'hash_name' => $hash_name,
                'ext' => $file_ext,
            ];
        } else {
            return [
                'name' => '',
                'hash_name' => '',
                'ext' => '',
            ];
        }
    }
}
