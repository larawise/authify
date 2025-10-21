<?php

namespace Larawise\Authify\Concerns;

use Illuminate\Http\Request;

/**
 * Srylius - The ultimate symphony for technology architecture!
 *
 * @package     Larawise
 * @subpackage  Authify
 * @version     v1.0.0
 * @author      Selçuk Çukur <hk@selcukcukur.com.tr>
 * @copyright   Srylius Teknoloji Limited Şirketi
 *
 * @see https://docs.larawise.com/ Larawise : Docs
 */
trait InteractsWithLocalization
{
    /**
     * The callable that resolves the user's country.
     *
     * @var (callable(Request):(?string))|null
     */
    public static $userCountryCallback = null;

    /**
     * The callable that resolves the user's currency.
     *
     * @var (callable(Request):(?string))|null
     */
    public static $userCurrencyCallback = null;

    /**
     * The callable that resolves the user's locale.
     *
     * @var (callable(Request):(?string))|null
     */
    public static $userLocaleCallback = null;

    /**
     * The callable that resolves the user's theme.
     *
     * @var (callable(Request):(?string))|null
     */
    public static $userThemeCallback = null;

    /**
     * The callable that resolves the user's timezone.
     *
     * @var (callable(Request):(?string))|null
     */
    public static $userTimezoneCallback = null;

    /**
     * Set the callable that resolves the user's country.
     *
     * @param (callable(Request):(?string))|null $callback
     *
     * @return static
     */
    public static function userCountry($callback)
    {
        static::$userCountryCallback = $callback;

        return new static;
    }

    /**
     * Set the callable that resolves the user's preferred currency.
     *
     * @param (callable(Request):(?string))|null $callback
     *
     * @return static
     */
    public static function userCurrency($callback)
    {
        static::$userCurrencyCallback = $callback;

        return new static;
    }

    /**
     * Set the callable that resolves the user's preferred locale.
     *
     * @param (callable(Request):(?string))|null $callback
     *
     * @return static
     */
    public static function userLocale($callback)
    {
        static::$userLocaleCallback = $callback;

        return new static;
    }

    /**
     * Set the callable that resolves the user's preferred theme.
     *
     * @param (callable(Request):(?string))|null $callback
     *
     * @return static
     */
    public static function userTheme($callback)
    {
        static::$userThemeCallback = $callback;

        return new static;
    }

    /**
     * Set the callable that resolves the user's preferred timezone.
     *
     * @param (callable(Request):(?string))|null $callback
     *
     * @return static
     */
    public static function userTimezone($callback)
    {
        static::$userTimezoneCallback = $callback;

        return new static;
    }

    /**
     * Resolve the user's country.
     *
     * @param Request $request
     *
     * @return string|null
     */
    public static function resolveUserCountry(Request $request)
    {
        if (static::$userCountryCallback) {
            return call_user_func(static::$userCountryCallback, $request);
        }

        return null;
    }

    /**
     * Resolve the user's preferred currency.
     *
     * @param Request $request
     *
     * @return string
     */
    public static function resolveUserCurrency(Request $request)
    {
        $currency = null;

        if (static::$userCurrencyCallback) {
            $currency = call_user_func(static::$userCurrencyCallback, $request);
        }

        return $currency ?? config('app.currency', 'USD');
    }

    /**
     * Resolve the user's preferred locale.
     *
     * @param Request $request
     *
     * @return string
     */
    public static function resolveUserLocale(Request $request)
    {
        $locale = null;

        if (static::$userLocaleCallback) {
            $locale = call_user_func(static::$userLocaleCallback, $request);
        }

        return str_replace('_', '-', $locale ?? app()->getLocale());
    }

    /**
     * Resolve the user's preferred theme.
     *
     * @param Request $request
     *
     * @return string|null
     */
    public static function resolveUserTheme(Request $request)
    {
        $theme = null;

        if (static::$userThemeCallback) {
            return call_user_func(static::$userThemeCallback, $request);
        }

        return $theme ?? config('app.theme', 'light');
    }

    /**
     * Resolve the user's preferred timezone.
     *
     * @param Request $request
     *
     * @return string|null
     */
    public static function resolveUserTimezone(Request $request)
    {
        $timezone = null;

        if (static::$userTimezoneCallback) {
            return call_user_func(static::$userTimezoneCallback, $request);
        }

        return $timezone ?? config('app.timezone', 'UTC');
    }
}
