<?php

namespace Illuminates\Sessions;

class Session
{

    public  function __construct() {
        session_save_path(config('session.path'));
        ini_set('session.gc_grobablity', 1);
        session_start([
            'cookie_lifetime' => config('session.expiration_timeout'),
        ]);
    }

    /**
     * Undocumented function
     *
     * @param string $key
     * @param mixed $value
     * @return mixed
     */
    public static  function  make(string $key, mixed $value = null): mixed
    {
        if (!is_null($value)) {
            $_SESSION[$key] = encrypt($value);
        }
        return isset($_SESSION[$key]) ? decrypt($_SESSION[$key]) : '';
    }
    /**
     * Undocumented function
     *
     * @param string $key
     * @return mixed
     */
    public static  function  get(string $key): mixed
    {
        return isset($_SESSION[$key]) ? decrypt($_SESSION[$key]) : $key;
    }

    /**
     * Undocumented function
     *
     * @param string $key
     * @return boolean
     */
    public static function has(string $key): bool
    {
        return isset($_SESSION[$key]);
    }

    /**
     * Undocumented function
     *
     * @param string $key
     * @return void
     */
    public static function forget(string $key): void
    {
        if (isset($_SESSION[$key])) {
            unset($_SESSION[$key]);
        }
    }
    /**
     * Undocumented function
     *
     * @param string $key
     * @param mixed $value
     * @return mixed
     */
    public static function flash(string $key, mixed $value = null): mixed
    {
        if (!is_null($value)) {
            $_SESSION[$key] = $value;
        }
        $session = isset($_SESSION[$key]) ? decrypt($_SESSION[$key]) : '';
        self::forget($key);
        return $session;
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public static function session_delete_all(): void
    {
        session_destroy();
    }
}
