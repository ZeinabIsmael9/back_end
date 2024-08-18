<?php

if (!function_exists('session')) {
    /**
     * Get or set a session variable with encryption.
     *
     * If a value is provided, the function sets the session variable after encrypting the value.
     * If no value is provided, it retrieves and decrypts the session variable.
     *
     * @param string $key The session key.
     * @param mixed|null $value The value to set in the session (optional).
     * @return mixed The decrypted session value if exists, or an empty string if not.
     */
    function session(string $key, mixed $value = null): mixed {
        if (!is_null($value)) {
            $_SESSION[$key] = encrypt($value);
        }
        return isset($_SESSION[$key]) ? decrypt($_SESSION[$key]) : '';
    }
}
// $encrypt =encrypt("Welcome TO PHP v8.3");
// //echo $encrypt."<br>";
// decrypt($encrypt);
if (!function_exists('session_has')) {
    /**
     * Check if a session variable exists.
     *
     * @param string $key The session key to check.
     * @return bool True if the session variable exists, false otherwise.
     */
    function session_has(string $key): bool {
        return isset($_SESSION[$key]);
    }
}

if (!function_exists('session_flash')) {
    /**
     * Set a session variable temporarily and retrieve it, then remove it from the session.
     *
     * @param string $key The session key.
     * @param mixed|null $value The value to set in the session (optional).
     * @return mixed The session value if exists, or an empty string if not.
     */
    function session_flash(string $key, mixed $value = null): mixed {
        if (!is_null($value)) {
            $_SESSION[$key] = $value;
        }
        $session = isset($_SESSION[$key]) ? $_SESSION[$key] : '';
        session_forget($key);
        return $session;
    }
}

if (!function_exists('session_forget')) {
    /**
     * Remove a session variable.
     *
     * @param string $key The session key to remove.
     * @return void
     */
    function session_forget(string $key) {
        if (isset($_SESSION[$key])) {
            unset($_SESSION[$key]);
        }
    }
}

if (!function_exists('session_delete_all')) {
    /**
     * Destroy all session data.
     *
     * @return void
     */
    function session_delete_all() {
        session_destroy();
    }
}
