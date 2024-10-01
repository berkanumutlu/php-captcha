<?php

namespace App\Config;

return [
    'captcha_type' => 'recaptcha',
    'recaptcha'    => [
        'api_url'         => 'https://www.google.com/recaptcha/api/siteverify',
        'script_file_url' => 'https://www.google.com/recaptcha/api.js',
        'site_key'        => 'YOUR_SITE_KEY',
        'secret_key'      => 'YOUR_SECRET_KEY'
    ]
];