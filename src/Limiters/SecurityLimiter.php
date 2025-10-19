<?php

namespace Larawise\Authify;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Larawise\Support\Traits\Throttleable;

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
class SecurityLimiter
{
    use Throttleable;

    /**
     * Get the time window in seconds during which rate limit attempts are tracked.
     *
     * @param Request $request
     *
     * @return string
     */
    protected function key(Request $request)
    {
        return Str::transliterate('authify_security|'.$request->ip());
    }

    /**
     * Get the time window in seconds during which rate limit attempts are tracked.
     *
     * @return int
     */
    protected function decaySeconds()
    {
        return config('authify.limiters.security.decay_seconds', 900);
    }

    /**
     * Get the maximum number of allowed attempts within the decay window.
     *
     * @return int
     */
    protected function maxAttempts()
    {
        return config('authify.limiters.security.max_attempts', 5);
    }
}
