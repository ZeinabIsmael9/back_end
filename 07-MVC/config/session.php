<?php
return [
    'expiration_timeout' => 86400,
    'encryption_mode' => config('app.cipher'), 
    'encryption_key' => config('app.key'), 
    'path' => base_path('storage/sessions'),
];

