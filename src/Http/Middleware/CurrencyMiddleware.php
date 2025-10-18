<?php

namespace Larawise\Authify\Http\Middleware;

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
class CurrencyMiddleware
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
        // Check if language preference is present in session data.
        $session = $request->session()->has('srylius_user_currency');

        // Check if there is a language preference in the cookie data
        $cookie = $request->cookie('srylius_user_currency');

        // If authorized, learn the user's currency preference.
        $preference = $request->user() ? $request->user()->currency : null;

        // Check if the user is present, and if so, find out the local language preference.
        if ($preference) {
            // Srylius :: If the language is available, apply it.
            app('config')->set('app.currency', $preference);

            // Srylius :: Update session data when the session is logged out or for any extra events that may occur.
            session()->put('srylius_user_currency', $preference);

            // Srylius :: Update cookie data when the session is logged out or for any extra events that may occur.
            cookie()->queue('srylius_user_currency', $preference, 36000);

            // Srylius :: Continue to next middleware.
            return $next($request);
        }

        // If the user is a visitor, use the language selected with the session data.
        if ($session)
            app('config')->set('app.currency', $request->session()->get('srylius_user_currency'));

        // If the user is a visitor, use the language selected with the cookie data.
        if ($cookie)
            app('config')->set('app.currency', $cookie);

        // If there is no preference then set it to the fallback locale.
        if (!$session && !$cookie)
            app('config')->set('app.currency', config('app.fallback_currency'));

        // Continue to next middleware.
        return $next($request);
    }
}
