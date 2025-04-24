<?php

namespace Illuminates\Views;

class View
{
    protected static $cashDir;
    /**
     * setup cash and check if view cashing path is exists
     * @return void
     */
    public static function prepare_cashe()
    {
        static::$cashDir = config('view.cash_dir');
        if (!is_dir(static::$cashDir)) {
            mkdir(static::$cashDir, 0755, true);
        }
    }


    /**
     * render tpl files
     * @param mixed $view
     * @param null|array $data
     * 
     * @return mixed
     */
    public static function make($view, null|array $data)
    {
        if (config('view.cash') == true) {
            static::prepare_cashe();
            $cash_file = static::getCashFilePath($view);
            if (static::isCashValid($cash_file)) {
                return include $cash_file;
            } else {
                $output = static::genrateViewOutPut($view, $data);
                file_put_contents(static::getCashFilePath($view), $output);
                return $output;
            }
        } else {
            $view = str_replace('.', '/', $view);
            $path = config('view.path');
            extract($data);
            return include $path . '/' . $view . ".tpl.php";
        }
    }


    /**
     * generate cash  path
     * @param mixed $view
     * 
     * @return string
     */
    protected static function getCashFilePath($view):string
    {
        return static::$cashDir . md5(config('view.path') . $view) . '.cash.php';
    }


    /**
     * check if cash file is exists
     * @param mixed $file
     * 
     * @return bool
     */
    protected static function isCashValid($file):bool
    {
        return file_exists($file);
    }


    /**
     * generate view output and clean output after generate
     * @param mixed $view
     * @param mixed $data
     * 
     * @return mixed
     */
    protected static function genrateViewOutPut($view, $data)
    {
        $view = str_replace('.', '/', $view);
        $path = config('view.path');
        extract($data);
        ob_start();
        include $path . '/' . $view . ".tpl.php";
        return ob_get_clean();
    }
}
