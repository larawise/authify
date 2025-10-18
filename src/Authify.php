<?php

namespace Larawise\Authify;

class Authify
{
    /**
     * The callback that is responsible for building the authentication pipeline array, if applicable.
     *
     * @var callable|null
     */
    public static $authenticateThroughCallback;

    /**
     * The callback that is responsible for validating authentication credentials, if applicable.
     *
     * @var callable|null
     */
    public static $authenticateUsingCallback;

    /**
     * The model casses used by Authify.
     *
     * @var string[]
     */
    public static $models = [
        'action' => 'Larawise\\Authify\\Models\\Action',
        'address' => 'Larawise\\Authify\\Models\\Address',
        'department' => 'Larawise\\Authify\\Models\\Department',
        'group' => 'Larawise\\Authify\\Models\\Group',
        'organization' => 'Larawise\\Authify\\Models\\Organization',
        'position' => 'Larawise\\Authify\\Models\\Position',
        'role' => 'Larawise\\Authify\\Models\\Role',
        'team' => 'Larawise\\Authify\\Models\\Team',
        'user' => 'Larawise\\Authify\\Models\\User',
        'workspace' => 'Larawise\\Authify\\Models\\Workspace'
    ];

    /**
     * Get the username used for authentication.
     *
     * @return string
     */
    public static function username()
    {
        return config('authify.username', 'nickname');
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

    /**
     * Get the name of the email address request variable / field.
     *
     * @return string
     */
    public static function phone()
    {
        return config('authify.email', 'phone');
    }

    /**
     * Get the class name of a model used by Authify.
     *
     * @return string
     */
    public static function model(string $key)
    {
        return static::$models[$key];
    }

    /**
     * Create a new instance of a model used by Authify.
     *
     * @param string $key
     *
     * @return mixed
     */
    public static function newModel(string $key)
    {
        $model = static::model($key);

        return new $model;
    }

    /**
     * Specify the model class that should be used by Authify.
     *
     * @param string $key
     * @param string $class
     *
     * @return static
     */
    public static function useModel(string $key, string $class)
    {
        static::$models[$key] = $class;

        return new static;
    }
}
