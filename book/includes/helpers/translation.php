<?php
if (!function_exists('trans')) {
    function trans(string $key = null, string $default = null): string
    {
        $trans = explode('.', $key);
        if (session_has('locale')) {
            $default = session('locale');
        } else {
            $default = config('lang.default') ?? config('lang.fallback');
        }

        $path = config('lang.path') . '/' . $default . '/' . $trans[0] . ".php";

        if (file_exists($path) && count($trans) > 1) {
            $result = include $path;
            return isset($result[$trans[1]]) ? $result[$trans[1]] : $key;
        }

        return $key;
    }
}

if (!function_exists('set_locale')) {
    function set_locale(string $lang = null)
    {
        session('locale', $lang);
    }
}
