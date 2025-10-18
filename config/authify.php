<?php

return [
    'prefix'                                => env('AUTHIFY_ADMIN_PREFIX', 'admin'),





    /*
    |--------------------------------------------------------------------------
    | ℹ️ Authify (Prefix)
    |--------------------------------------------------------------------------
    |
    | Adding request limits to transactions and specific pages is one of the
    | most important steps for security measures. Srylius allows you to change
    | this built-in and optionally configurable.
    |
    */
    'prefix'                                => env('AUTHIFY_ADMIN_PREFIX', 'admin'),

    /*
    |--------------------------------------------------------------------------
    | ℹ️ Authify (Guards)
    |--------------------------------------------------------------------------
    */
    'guards'                                    => [
        'web'   => [
            'driver'    => 'session',
            'provider'  => 'web',
        ],
        'admin' => [
            'driver'    => 'session',
            'provider'  => 'admin',
        ],
        'api'   => [
            'driver'    => 'sanctum',
            'provider'  => 'api'
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | ℹ️ Authify (Providers)
    |--------------------------------------------------------------------------
    */
    'providers'                                 => [
        'web'   => [
            'driver'    => 'eloquent',
            'model'     => Larawise\Authify\Models\User::class,
        ],
        'admin' => [
            'driver'    => 'eloquent',
            'model'     => Larawise\Authify\Models\User::class,
        ],
        'api'   => [
            'driver'    => 'eloquent',
            'model'     => Larawise\Authify\Models\User::class,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | ℹ️ Authify (Pipelines)
    |--------------------------------------------------------------------------
    */
    'pipelines'                                 => [
        'login'     => null,
    ],

    /*
    |--------------------------------------------------------------------------
    | ℹ️ Authify (Limiters)
    |--------------------------------------------------------------------------
    |
    | Adding request limits to transactions and specific pages is one of the
    | most important steps for security measures. Srylius allows you to change
    | this built-in and optionally configurable.
    |
    */
    'limiters'                              => [
        'login'         => [
            'status'    => (bool) env('AUTHIFY_LOGIN_LIMITER', true),
            'delay'     => (int) env('AUTHIFY_LOGIN_DELAY', 900),
            'attempt'   => (int) env('AUTHIFY_LOGIN_ATTEMPT', 3),
            'lock'      => (bool) env('AUTHIFY_LOGIN_LOCK', false),
        ],
        'security'      => [
            'status'    => (bool) env('AUTHIFY_SECURITY_LIMITER', true),
            'delay'     => (int) env('AUTHIFY_SECURITY_DELAY', 900),
            'attempt'   => (int) env('AUTHIFY_SECURITY_ATTEMPT', 3),
            'lock'      => (bool) env('AUTHIFY_SECURITY_LOCK', false),
        ],
        'forgot'        => [
            'status'    => (bool) env('AUTHIFY_FORGOT_LIMITER', true),
            'delay'     => (int) env('AUTHIFY_FORGOT_DELAY', 900),
            'attempt'   => (int) env('AUTHIFY_FORGOT_ATTEMPT', 3),
            'lock'      => (bool) env('AUTHIFY_FORGOT_LOCK', false),
        ],
        'reset'         => [
            'status'    => (bool) env('AUTHIFY_RESET_LIMITER', true),
            'delay'     => (int) env('AUTHIFY_RESET_DELAY', 900),
            'attempt'   => (int) env('AUTHIFY_RESET_ATTEMPT', 3),
            'lock'      => (bool) env('AUTHIFY_RESET_LOCK', false),
        ],
        'register'      => [
            'status'    => (bool) env('AUTHIFY_REGISTER_LIMITER', true),
            'delay'     => (int) env('AUTHIFY_REGISTER_DELAY', 86400),
            'attempt'   => (int) env('AUTHIFY_REGISTER_ATTEMPT', 1),
            'lock'      => (bool) env('AUTHIFY_REGISTER_LOCK', true),
        ]
    ],
];
