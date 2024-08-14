<?php

if (!function_exists('config')) {
    /**
     * Get a configuration value from a configuration file.
     *
     * @param string $key The configuration key in the format 'file.key'.
     * @return mixed|null The configuration value, or null if not found.
     */
        function config(string $key) {
            $config = explode('.', $key);
            if (count($config) > 0) {
                $result = include base_path('config/' . $config[0] . ".php");
                return $result[$config[1]] ?? null;
            }
            return null;
        }
    }


if (!function_exists('base_path')) {
    /**
     * Get the base path of the application.
     *
     * @param string $path The relative path to append to the base path.
     * @return string The full path from the base directory.
     */
    function base_path($path = '') {
        return rtrim(getcwd(), '/') . '/../' . ltrim($path, '/');
    }
}




if (!function_exists('public_path')) {
    /**
     * Get the public path of the application.
     *
     * @param string $path The relative path to append to the public path.
     * @return string The full path from the base directory.
     */
    function public_path($path = '') {
        return base_path('public/' . ltrim($path, '/'));
    }
}



if (!function_exists('public_')) {
    /**
     * Get the public path segment of the application.
     *
     * @return string The public path segment.
     */
    function public_() {
        return 'back_end/03-practicing/public';
    }
    //echo "aaaaa";

}

