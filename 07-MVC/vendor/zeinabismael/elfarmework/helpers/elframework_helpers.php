<?php


if (!function_exists('trans')) {
    function trans(string $trans = ''): string|object
    {
        return
            !empty($trans) ? \Illuminates\Locales\Lang::get($trans)
            : new \Illuminates\Locales\Lang;
    }
}



if (!function_exists('view')) {
    function view(string $view, null|array $data): mixed
    {
        return \Illuminates\Views\View::make($view, $data);
    }
}


if (!function_exists('url')) {
    function url(string $url = ''): string
    {
        // var_dump($_SERVER['HTTP_HOST']);
        // $basePath = '/back_end/07-MVC/public/';
        return $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . ROOT_DIR . ltrim($url, '/');
    }
}

if (!function_exists('base_path')) {
    function base_path(string $file)
    {
        return ROOT_PATH . '/../' . $file;
    }
}

if (!function_exists('storage_path')) {
    function storage_path(string $path)
    {
        return !is_null($path) ? base_path('storage') . '/' . $path : "";
    }
}

if (!function_exists('route_path')) {
    function route_path(string $file)
    {
        return !is_null($file) ? config('route.path') . '/' . $file : config('route.path');
    }
}

if (!function_exists('config')) {
    function config(string $file)
    {
        $seprate = explode('.', $file);
        if ((!empty($seprate) && count($seprate) > 1) && !is_null($file)) {
            $file = include base_path('config/') . $seprate[0] . '.php';
            return isset($file[$seprate[1]]) ? $file[$seprate[1]] : $file;
            // var_dump($seprate[1]);
        }
        return '';
    }
}



if (!function_exists('public_path')) {
    function public_path(string $file)
    {
        return !empty($file) ? getcwd() . '/' . $file : getcwd();
        //return !is_null($file)?config('public.path').'/'.$file : config('public.path');
    }
}


if (!function_exists('bcrypt')) {
    function bcrypt(string $str)
    {
        return \Illuminates\Hashes\Hash::make($str);
    }
}

if (!function_exists('hash_check')) {
    function hash_check(string $pass, string $hash)
    {
        return \Illuminates\Hashes\Hash::check($pass, $hash);
    }
}


if (!function_exists('encrypt')) {
    function encrypt(string $value)
    {
        return \Illuminates\Hashes\Hash::encrypt($value);
    }
}


if (!function_exists('decrypt')) {
    function decrypt(string $value)
    {
        return \Illuminates\Hashes\Hash::decrypt($value);
    }
}
