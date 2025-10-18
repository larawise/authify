<?php

namespace Larawise\Authify;

use Illuminate\Support\Str;

class Authify
{
    /**
     * Get the name of the username request variable / field.
     *
     * @return string
     */
    public static function username()
    {
        return config('authify.identity.username.field', 'username');
    }

    /**
     * Get the name of the phone number request variable / field.
     *
     * @return string
     */
    public static function phone()
    {
        return config('authify.identity.phone.field', 'phone');
    }

    /**
     * Get the name of the email address request variable / field.
     *
     * @return string
     */
    public static function email()
    {
        return config('authify.identity.email.field', 'email');
    }

    /**
     * Get the list of enabled identity fields based on Authify config.
     *
     * @return array<string>
     */
    public static function enabledIdentityFields()
    {
        $fields = static::identityFields();

        foreach ($fields as $field) {
            $fields[] = $field;
        }

        return array_values($fields);
    }

    /**
     * Get the list of identity field names used for authentication.
     *
     * @return array<string>
     */
    public static function identityFields()
    {
        $identity = config('authify.identity', []);

        $fields = [];

        foreach ($identity as $item) {
            if (! empty($item['field'])) {
                $fields[] = $item['field'];
            }
        }

        return array_values(array_unique($fields));
    }

    /**
     * Normalize identity input based on field type.
     *
     * @param string $field
     * @param mixed $value
     *
     * @return string|mixed
     */
    public static function identityNormalize($field, $value)
    {
        return match ($field) {
            'username'  => Str::of($value)->lower()->trim()->replaceMatches('/[^a-z0-9._-]/i', ''),
            'email'     => Str::of($value)->lower()->trim()->replaceMatches('/[^a-z0-9@._-]/i', ''),
            'phone'     => Str::of($value)->trim()->replaceMatches('/[^0-9+]/', ''),
            default     => $value,
        };
    }

    /**
     * Check if a specific identity field is enabled in Authify config.
     *
     * @param string $field
     *
     * @return bool
     */
    public static function identityStatus($field)
    {
        $identity = config("authify.identity.{$field}", false);

        return ! empty($identity['status']) && $identity['status'] === true;
    }
}
