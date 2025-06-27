<?php

namespace Illuminates\Sessions;

use SessionHandler;

class Session
{
    public function __construct() {}

    public static function start()
    {
        if (session_status() === PHP_SESSION_NONE) {
            $handler = new SessionHandler(
                config('session.path'),
                config('session.session_prefix')
            );

            session_set_save_handler($handler, true);
            session_name(config('session.session_prefix'));
            session_start();
            $handler->gc(config('session.expiration_timeout'));
        }
    }

    /**
     * Undocumented function
     *
     * @param string $key
     * @param mixed $value
     * @return mixed
     */
    public static function make(string $key, mixed $value = null): mixed
    {
        static::start();

        if (!is_null($value)) {
            $_SESSION[$key] = encrypt($value);
            session_write_close();
        }
        return isset($_SESSION[$key]) ? decrypt($_SESSION[$key]) : '';
    }

    /**
     * Undocumented function
     *
     * @param string $key
     * @return mixed
     */
    public static function get(string $key): mixed
    {
        static::start();
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
        static::start();
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
        static::start();
        if (isset($_SESSION[$key])) {
            unset($_SESSION[$key]);
        }
    }

    public static function forget_all(): void
    {
        static::start();
        session_destroy();
    }

    public static function destroy(): void
    {
        session_destroy();
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
        static::start();
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
