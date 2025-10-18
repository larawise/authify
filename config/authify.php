<?php

return [
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
            'status'    => true,
            'field'     => 'username',
        ],
        'email'     => [
            'status'    => true,
            'field'     => 'email',
        ],
        'phone'     => [
            'status'    => true,
            'field'     => 'phone',
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
    | - delay: Lockout duration in seconds after exceeding attempts.
    | - attempt: Maximum number of allowed attempts within the delay window.
    | - lock: Whether to enforce a hard lock (e.g., manual unlock required).
    |
    */
    'limiters'                              => [
        'login'         => [
            'status'    => (bool) env('AUTHIFY_LOGIN_LIMITER', true),
            'delay'     => (int) env('AUTHIFY_LOGIN_DELAY', 900),
            'attempt'   => (int) env('AUTHIFY_LOGIN_ATTEMPT', 5),
            'lock'      => (bool) env('AUTHIFY_LOGIN_LOCK', false),
        ],
        'security'      => [
            'status'    => (bool) env('AUTHIFY_SECURITY_LIMITER', true),
            'delay'     => (int) env('AUTHIFY_SECURITY_DELAY', 900),
            'attempt'   => (int) env('AUTHIFY_SECURITY_ATTEMPT', 5),
            'lock'      => (bool) env('AUTHIFY_SECURITY_LOCK', false),
        ],
        'forgot'        => [
            'status'    => (bool) env('AUTHIFY_FORGOT_LIMITER', true),
            'delay'     => (int) env('AUTHIFY_FORGOT_DELAY', 900),
            'attempt'   => (int) env('AUTHIFY_FORGOT_ATTEMPT', 5),
            'lock'      => (bool) env('AUTHIFY_FORGOT_LOCK', false),
        ],
        'reset'         => [
            'status'    => (bool) env('AUTHIFY_RESET_LIMITER', true),
            'delay'     => (int) env('AUTHIFY_RESET_DELAY', 900),
            'attempt'   => (int) env('AUTHIFY_RESET_ATTEMPT', 5),
            'lock'      => (bool) env('AUTHIFY_RESET_LOCK', false),
        ],
        'register'      => [
            'status'    => (bool) env('AUTHIFY_REGISTER_LIMITER', true),
            'delay'     => (int) env('AUTHIFY_REGISTER_DELAY', 86400),
            'attempt'   => (int) env('AUTHIFY_REGISTER_ATTEMPT', 5),
            'lock'      => (bool) env('AUTHIFY_REGISTER_LOCK', false),
        ]
    ],
];
