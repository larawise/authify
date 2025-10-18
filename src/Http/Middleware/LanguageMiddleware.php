<?php

namespace Larawise\Authify\Http\Middleware;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

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
class LanguageMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param \Closure $next
     *
     * @return mixed
     */
    public function handle(Request $request, \Closure $next)
    {
        $browser = collect($request->getLanguages())->first();
        $browser = substr($browser, 0, 2);

        // Check if language preference is present in session data.
        $session = $request->session()->has('srylius_user_language');

        // Check if there is a language preference in the cookie data
        $cookie = $request->cookie('srylius_user_language');

        // If authorized, learn the user's language preference.
        $preference = $request->user() ? $request->user()->language : null;

        // Srylius ::
        if ($browser) {
            // Srylius :: If the language is available, apply it.
            app()->setLocale($browser);

            // Srylius :: Set the default language for the zend framework.
            setlocale(LC_ALL, $browser);

            // Srylius :: Set the default language for the carbon library.
            Carbon::setLocale($browser);
        }

        // Check if the user is present, and if so, find out the local language preference.
        if ($preference && $request->user()) {
            // Srylius :: If the language is available, apply it.
            app()->setLocale($preference);

            // Srylius :: Set the default language for the zend framework.
            setlocale(LC_ALL, $preference);

            // Srylius :: Set the default language for the carbon library.
            Carbon::setLocale($preference);

            // Srylius :: Update session data when the session is logged out or for any extra events that may occur.
            session()->put('srylius_user_language', $preference);

            // Srylius :: Update cookie data when the session is logged out or for any extra events that may occur.
            cookie()->queue('srylius_user_language', $preference, 36000);

            // Srylius :: Continue to next middleware.
            return $next($request);
        }

        // If the user is a visitor, use the language selected with the session data.
        if ($session) {
            // Srylius :: If the language is available, apply it.
            app()->setLocale($session);

            // Srylius :: Set the default language for the zend framework.
            setlocale(LC_ALL, $session);

            // Srylius :: Set the default language for the carbon library.
            Carbon::setLocale($session);
        }

        // If the user is a visitor, use the language selected with the cookie data.
        if ($cookie) {
            // Srylius :: If the language is available, apply it.
            app()->setLocale($cookie);

            // Srylius :: Set the default language for the zend framework.
            setlocale(LC_ALL, $cookie);

            // Srylius :: Set the default language for the carbon library.
            Carbon::setLocale($cookie);
        }

        // If there is no preference then set it to the fallback locale.
        if (!$session && !$cookie && !$preference && !$browser) {
            // Srylius :: If the language is available, apply it.
            app()->setLocale(app()->getFallbackLocale());

            // Srylius :: Set the default language for the zend framework.
            setlocale(LC_ALL, app()->getFallbackLocale());

            // Srylius :: Set the default language for the carbon library.
            Carbon::setLocale(app()->getFallbackLocale());
        }

        // Continue to next middleware.
        return $next($request);
    }
}
