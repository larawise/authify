<?php

return [
    /*
    |--------------------------------------------------------------------------
    | ℹ️ Authify (Username)
    |--------------------------------------------------------------------------
    |
    | This value defines which request variable or model attribute should be
    | treated as the "username" identifier during authentication. In Authify,
    | this can be customized to support multiple login strategies such as
    | username, email, or phone number.
    |
    | The value is used across login, security verification, and session
    | management flows. You may override it to match your application's
    | preferred identity field.
    |
    */
    'username' => 'username',

    /*
    |--------------------------------------------------------------------------
    | ℹ️ Authify (Phone)
    |--------------------------------------------------------------------------
    |
    | This value defines the name of the request variable or model attribute
    | representing the user's phone number. Authify uses this field optionally
    | for login, verification, and recovery flows.
    |
    | If your application supports phone-based authentication or security
    | checks, you may customize this value accordingly.
    |
    */
    'phone' => 'phone',

    /*
    |--------------------------------------------------------------------------
    | ℹ️ Authify (Email)
    |--------------------------------------------------------------------------
    |
    | This value defines the name of the request variable or model attribute
    | representing the user's email address. Authify uses this field optionally
    | for login, password recovery, and identity verification.
    |
    | You may override this value if your application uses a different field
    | name for email-based authentication.
    |
    */
    'email' => 'email',

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
