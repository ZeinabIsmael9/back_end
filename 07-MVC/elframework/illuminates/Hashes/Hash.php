<?php

namespace Illuminates\Hashes;

class Hash
{
    /**
     * Undocumented function
     *
     * @param string $value
     * @return string
     */
    public static function encrypt(string $value): string
    {
        $cipher = config('session.encryption_mode');
        $key = config('session.encryption_key');
        $ivlen = openssl_cipher_iv_length($cipher);
        $iv = openssl_random_pseudo_bytes($ivlen);
        $ciphertext_raw = openssl_encrypt($value, $cipher, $key, OPENSSL_RAW_DATA, $iv);
        $hmac = hash_hmac('sha256', $ciphertext_raw, $key, true);
        $ciphertext = base64_encode($iv . $hmac . $ciphertext_raw);
        // var_dump($ciphertext );
        return $ciphertext;
    }
    /**
     * Undocumented function
     *
     * @param string $ciphertext
     * @return string
     */
    public static function decrypt(string $ciphertext): string
    {
        $cipher = config('session.encryption_mode');
        $key = config('session.encryption_key');
        $ivlen = openssl_cipher_iv_length($cipher);
        $convert = base64_decode($ciphertext);
        $iv = substr($convert, 0, $ivlen);
        $hmac = substr($convert, $ivlen, 32);
        $ciphertext_raw = substr($convert, 32 + $ivlen);
        $original_text = openssl_decrypt($ciphertext_raw, $cipher, $key, OPENSSL_RAW_DATA, $iv);
        $calcmac = hash_hmac('sha256', $ciphertext_raw, $key, true);
        if (hash_equals($calcmac, $hmac)) {
            return ($original_text);
        }
        return '';
    }

    /**
     * Undocumented function
     *
     * @param string $password
     * @return string
     */
    public static function  make(string $password): string
    {
        return password_hash($password, config('hash.bcrypt_algo'));
    }

    /**
     * Undocumented function
     *
     * @param string $password
     * @param string $hash
     * @return boolean
     */
    public static function check(string $password, string $hash): bool
    {
        return password_verify($password, $hash);
    }
}
