<?php

return [
    'rules'                                 => [
        'password' => [
            'min'           => 6,
            'max'           => 0,
            'mixed_case'    => false,
            'numbers'       => false,
            'symbols'       => false,
            'uncompromised' => [
                'status'        => false,
                'threshold'     => 0
            ],
            'not_valid'     => false,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | ℹ️ Authify (Identity)
    |--------------------------------------------------------------------------
    |
    | Authify supports multi-identifier authentication strategies such as
    | username, email, and phone number. Each identity type below can be
    | individually enabled or disabled, and mapped to a specific request
    | variable or model attribute.
    |
    | These fields are used across login, password reset, security checks,
    | and session flows. You may customize them to match your application's
    | preferred identity schema.
    |
    */
    'identity'                              => [
        'username'  => [
            'status'    => (bool) env('AUTHIFY_USERNAME_IDENTITY', true),
            'field'     => env('AUTHIFY_USERNAME_FIELD', 'username'),
        ],
        'email'     => [
            'status'    => (bool) env('AUTHIFY_EMAIL_IDENTITY', true),
            'field'     => env('AUTHIFY_EMAIL_FIELD', 'email'),
        ],
        'phone'     => [
            'status'    => (bool) env('AUTHIFY_PHONE_IDENTITY', true),
            'field'     => env('AUTHIFY_PHONE_FIELD', 'phone'),
        ]
    ],

    /*
    |--------------------------------------------------------------------------
    | ℹ️ Authify (Limiters)
    |--------------------------------------------------------------------------
    |
    | Adding request limits to transactions and specific pages is one of the
    | most important steps for security measures. Authify allows you to change
    | this built-in and optionally configurable.
    |
    | Each limiter group includes :
    | - status: Whether the limiter is active.
    | - decay: Lockout duration in seconds after exceeding attempts.
    | - attempt: Maximum number of allowed attempts within the delay window.
    | - lock: Whether to enforce a hard lock (e.g., manual unlock required).
    |
    */
    'limiters'                              => [
        'login'         => [
            'status'        => (bool) env('AUTHIFY_LOGIN_LIMITER', true),
            'decay_seconds' => (int) env('AUTHIFY_LOGIN_DECAY', 900),
            'max_attempts'  => (int) env('AUTHIFY_LOGIN_ATTEMPTS', 5),
            'locking'       => (bool) env('AUTHIFY_LOGIN_LOCK', false),
        ],
        'security'      => [
            'status'        => (bool) env('AUTHIFY_SECURITY_LIMITER', true),
            'decay_seconds' => (int) env('AUTHIFY_SECURITY_DECAY', 900),
            'max_attempts'  => (int) env('AUTHIFY_SECURITY_ATTEMPTS', 5),
            'locking'       => (bool) env('AUTHIFY_SECURITY_LOCK', false),
        ],
        'forgot'        => [
            'status'        => (bool) env('AUTHIFY_FORGOT_LIMITER', true),
            'decay_seconds' => (int) env('AUTHIFY_FORGOT_DECAY', 900),
            'max_attempts'  => (int) env('AUTHIFY_FORGOT_ATTEMPTS', 5),
            'locking'       => (bool) env('AUTHIFY_FORGOT_LOCK', false),
        ],
        'reset'         => [
            'status'        => (bool) env('AUTHIFY_RESET_LIMITER', true),
            'decay_seconds' => (int) env('AUTHIFY_RESET_DECAY', 900),
            'max_attempts'  => (int) env('AUTHIFY_RESET_ATTEMPTS', 5),
            'locking'       => (bool) env('AUTHIFY_RESET_LOCK', false),
        ],
        'register'      => [
            'status'        => (bool) env('AUTHIFY_REGISTER_LIMITER', true),
            'decay_seconds' => (int) env('AUTHIFY_REGISTER_DECAY', 86400),
            'max_attempts'  => (int) env('AUTHIFY_REGISTER_ATTEMPTS', 1),
            'locking'       => (bool) env('AUTHIFY_REGISTER_LOCK', false),
        ]
    ],
];
