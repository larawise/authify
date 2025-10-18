<?php

namespace Larawise\Authify;

class Authify
{
    /**
     * Get the name of the username request variable / field.
     *
     * @return string
     */
    public static function username()
    {
        return config('authify.username', 'username');
    }

    /**
     * Get the name of the phone number request variable / field.
     *
     * @return string
     */
    public static function phone()
    {
        return config('authify.phone', 'phone');
    }

    /**
     * Get the name of the email address request variable / field.
     *
     * @return string
     */
    public static function email()
    {
        return config('authify.email', 'email');
    }
}
