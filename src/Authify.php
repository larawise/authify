<?php

namespace Larawise\Authify;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;

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
     * Generate a configurable password validation rule based on authify settings.
     *
     * @return Password
     */
    public static function passwordRules()
    {
        $options = config('authify.rules.password');

        $rule = Password::min($options['min']);

        if ($options['max'] > 0) {
            $rule->max($options['max']);
        }

        if ($options['mixed_case'] ?? false) {
            $rule->mixedCase();
        }

        if ($options['numbers'] ?? false) {
            $rule->numbers();
        }

        if ($options['symbols'] ?? false) {
            $rule->symbols();
        }

        if ($options['uncompromised']['status']) {
            $rule->uncompromised($options['uncompromised']['threshold'] ?? 0);
        }

        return $rule;
    }

    /**
     * Determine which identity field is actively used in the request.
     *
     * @param Request $request
     *
     * @return string|null
     */
    public static function identityFieldResolve(Request $request)
    {
        foreach (self::identityFields(true) as $field) {
            if ($request->filled($field)) {
                return $field;
            }
        }

        return null;
    }

    /**
     * Retrieve identity field names used for authentication.
     *
     * @param bool $onlyActive
     *
     * @return array<string>
     */
    public static function identityFields($onlyActive = false)
    {
        $identity = config('authify.identity', []);

        $fields = [];

        foreach ($identity as $item) {
            if (! empty($item['field'])) {
                if ($onlyActive && ! ($item['enabled'] ?? false)) {
                    continue;
                }

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
    public static function identityPrepare($field, $value)
    {
        return match ($field) {
            'username' => Str::of($value)->lower()
                ->trim()
                ->replaceMatches('/[^a-z0-9._-]/i', '')
                ->toString(),

            'email' => Str::of($value)->lower()
                ->trim()
                ->replaceMatches('/[^a-z0-9@._-]/i', '')
                ->toString(),

            'phone' => Str::of($value)->trim()
                ->replaceMatches('/[^0-9+]/', '')
                ->toString(),

            default => $value,
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
