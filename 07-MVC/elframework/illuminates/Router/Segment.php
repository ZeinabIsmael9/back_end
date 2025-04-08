<?php
namespace Illuminates\Router;

/**
 *   @param int $offset
 *   @return string
 */
class Segment
{
    public static function uri(){
        return str_replace(ROOT_DIR , '', $_SERVER['REQUEST_URI']);
    }
    public static function get(int $offset):string {
        $uri = static::uri();
        $segments = explode('/', $uri);
        return isset($segments[$offset]) ? $segments[$offset] : '';
    }
    public static function all(){
        return explode('/', static::uri());
    }
}