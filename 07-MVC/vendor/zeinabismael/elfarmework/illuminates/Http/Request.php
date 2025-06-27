<?php

namespace Illuminates\Http;

class Request
{
    protected static array $file;
    protected static string $name;
    protected static string $ext;
    /**
     * Retrieve a value from the global $_REQUEST array.
     *
     * @param string $name The name of the request parameter.
     * @param mixed $default The default value to return if the parameter is not set or is empty.
     * @return mixed The value of the request parameter or the default value if not set.
     */

    public static function get(string $name = '', mixed $default = null)
    {
        if (isset($_REQUEST[$name]) && !empty($_REQUEST[$name])) {
            return $_REQUEST[$name];
        } else {
            return $default;
        }
    }

    /**
     * Retrieve all values from the global $_REQUEST array.
     *
     * @return array An associative array containing all the request parameters.
     */

    public static function all()
    {

        return count($_REQUEST) > 0 ? $_REQUEST : [];
    }

    /**
     * Retrieve the uploaded file from the global $_FILES array, 
     * extract its base name and extension, and store them in static properties.
     *
     * @param string $name The name of the file input field.
     * @return object An instance of the Request class.
     */

    public static function file(string $name): object
    {
        if (isset($_FILES[$name])) {
            static::$file = $_FILES[$name];
            $file_info = explode('.',  $_FILES[$name]['name']);
            static::$name = $file_info[0];
            static::$ext = end($file_info);
        }
        return new self;
    }

    /**
     * Return the extension of the file
     *
     * @return string
     */
    public static function ext(): string
    {
        return static::$ext;
    }

    /**
     * Return the name of the file
     *
     * @return string
     */
    /*******  1189bbc4-179d-433f-a6f4-67179cd8c2d9  *******/
    public static function name(string $name =''): string
    {
        if ($name) {
            static::$name = $name;
        }
        return static::$name;
    }


    /**
     * Store the uploaded file in the given path.
     *
     * @param string $to The path to store the file.
     * @return string|bool The path of the stored file or false if the file is not stored.
     */
    
    public static function store(string $to): bool|string
    {
        $from = static::$file;
        // var_dump(static::$name, static::$ext);
        // exit;
        if (isset($from['tmp_name'])) {
            $to_path = '/' . ltrim($to, '/');
            $path = config('storage.storage_path') . $to_path;
            if (!is_dir($path)) {
                mkdir($path, 0755, true);
            }
            $file = $path . '/' . static::$name . '.' . static::$ext;
            move_uploaded_file($from['tmp_name'], $file);
            return ltrim( $to_path . '/' . static::$name . '.' . static::$ext,'/');
        }
        return false;
    }
}
