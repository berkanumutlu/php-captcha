<?php

namespace App\Config;

return [
    'captcha_type' => 'recaptcha',
    'recaptcha'    => [
        'api_url'         => 'https://www.google.com/recaptcha/api/siteverify',
        'script_file_url' => 'https://www.google.com/recaptcha/api.js',
        'site_key'        => 'YOUR_SITE_KEY',
        'secret_key'      => 'YOUR_SECRET_KEY'
    ],
    'hcaptcha'     => [
        'api_url'         => 'https://api.hcaptcha.com/siteverify',
        'script_file_url' => 'https://js.hcaptcha.com/1/api.js',
        'site_key'        => 'YOUR_SITE_KEY',
        'secret_key'      => 'YOUR_SECRET_KEY'
    ],
    'turnstile'    => [
        'api_url'         => 'https://challenges.cloudflare.com/turnstile/v0/siteverify',
        'script_file_url' => 'https://challenges.cloudflare.com/turnstile/v0/api.js?render=explicit',
        'site_key'        => 'YOUR_SITE_KEY',
        'secret_key'      => 'YOUR_SECRET_KEY'
    ]
];