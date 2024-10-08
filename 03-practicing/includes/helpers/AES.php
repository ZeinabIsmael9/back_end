<?php

if(!function_exists('encrypt')){
    /**
     * encrypt Used to encyrpt plain text
     * @param string $value
     * @return string
     */
    function encrypt($value):string {
        $cipher= config('session.encryption_mode');
        $key = config('session.encryption_key');
        $ivlen = openssl_cipher_iv_length($cipher);
        $iv = openssl_random_pseudo_bytes($ivlen);
        $ciphertext_raw = openssl_encrypt($value,$cipher,$key,OPENSSL_RAW_DATA,$iv);
        $hmac = hash_hmac('sha256', $ciphertext_raw,$key,true);
        $ciphertext = base64_encode($iv.$hmac.$ciphertext_raw);
        //var_dump($ciphertext );
        return $ciphertext;

}
}


if(!function_exists('decrypt')){
    /**
     * decrypt Used to decyrpt plain text
     * @param string $ciphertext
     * @return string
     */
    function decrypt($ciphertext) {
        $cipher= config('session.encryption_mode');
        $key = config('session.encryption_key');
        $ivlen = openssl_cipher_iv_length($cipher);
        $convert = base64_decode($ciphertext);
        $iv = substr($convert, 0, $ivlen);
        $hmac = substr($convert, $ivlen, 32);
        $ciphertext_raw = substr($convert, 32 + $ivlen);
        $original_text = openssl_decrypt($ciphertext_raw,$cipher,$key,OPENSSL_RAW_DATA,$iv);
        $calcmac = hash_hmac('sha256', $ciphertext_raw,$key,true);
        if(hash_equals($calcmac,$hmac)){
            return($original_text);
        }return'';
    }
}