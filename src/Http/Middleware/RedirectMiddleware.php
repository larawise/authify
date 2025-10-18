<?php

namespace Larawise\Authify\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
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
class RedirectMiddleware extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param Request $request
     *
     * @return string|null
     */
    protected function redirectTo(Request $request)
    {
        // Srylius :: Check if the user is in the admin panel or normal interface.
        $route = $request->is('udspanel', 'udspanel/*')
            ? 'admin.login'
            : 'web.login';

        // Srylius :: If the user is not logged in, direct the user to the login screen.
        return $request->expectsJson()
            ? null
            : route($route);
    }
}
