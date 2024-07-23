<?php

if (!function_exists('send_mail')) {
    function send_mail(array $mails, string $subject, string $message): bool {
        if(config('mail.encrypt')=='smtp'){
            ini_set('SMTP',config('mail.SMTP_domain'));
            ini_set('SMTP',config('mail.SMTP_port'));
        }
        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
        $headers .= 'From: ' . config('mail.FROM_ADDRESS') . "\r\n";
        return mail($mails[0], $subject, $message, $headers);
    }
}

var_dump(send_mail(['fake@mail.com'], 'test message', 'content message'));
