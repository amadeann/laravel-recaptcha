<?php

return [
    'default' => 'v2_visible',

    'site_verify_url' => env('RECAPTCHA_SITE_VERIFY_URL', 'https://www.google.com/recaptcha/api/siteverify'),

    'containers' => [
        'v2_visible' => [
            'secret_key' => env('RECAPTCHA_SECRET_KEY_V2_VISIBLE'),
        ],
        'v2_invisible' => [
            'secret_key' => env('RECAPTCHA_SECRET_KEY_V2_INVISIBLE'),
        ],
        'v3' => [
            'secret_key' => env('RECAPTCHA_SECRET_KEY_V3'),
        ]
    ]
];
