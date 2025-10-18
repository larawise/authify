<?php

namespace Larawise\Authify;

use Illuminate\Cache\RateLimiter;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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
class AuthifyLimiter
{
    /**
     * The time window in seconds during which attempts are counted.
     *
     * @var int
     */
    protected $decaySeconds = 60;

    /**
     * The rate limiter instance responsible for tracking and enforcing limits.
     *
     * @var RateLimiter
     */
    protected $limiter;

    /**
     * The maximum number of allowed attempts within the decay period.
     *
     * @var int
     */
    protected $maxAttempts = 5;

    /**
     * A unique throttle key used to identify the request source (e.g., user ID or IP).
     *
     * @var string
     */
    protected $key;

    /**
     * Create a new authify rate limiter instance.
     *
     * @param RateLimiter $limiter
     *
     * @return void
     */
    public function __construct(RateLimiter $limiter)
    {
        $this->limiter = $limiter;
    }

    /**
     * Get the number of attempts for the given key and type.
     *
     * @param Request $request
     *
     * @return mixed
     */
    public function attempts(Request $request)
    {
        return $this->limiter->attempts($this->throttleKey($request));
    }

    /**
     * Determine if the user has too many failed login attempts.
     *
     * @param Request $request
     *
     * @return bool
     */
    public function tooManyAttempts(Request $request)
    {
        return $this->limiter->tooManyAttempts($this->throttleKey($request), $this->maxAttempts);
    }

    /**
     * Increment the login attempts for the user.
     *
     * @param Request $request
     *
     * @return void
     */
    public function increment(Request $request)
    {
        $this->limiter->hit($this->throttleKey($request), $this->decaySeconds);
    }

    /**
     * Determine the number of seconds until logging in is available again.
     *
     * @param Request $request
     *
     * @return int
     */
    public function availableIn(Request $request)
    {
        return $this->limiter->availableIn($this->throttleKey($request));
    }

    /**
     * Clear the login locks for the given user credentials.
     *
     * @param Request $request
     *
     * @return void
     */
    public function clear(Request $request)
    {
        $this->limiter->clear($this->throttleKey($request));
    }

    /**
     * Configure the throttle settings.
     *
     * @param string $key
     * @param int $maxAttempts
     * @param int $decaySeconds
     *
     * @return AuthifyLimiter
     */
    public function configure($key, $maxAttempts, $decaySeconds)
    {
        $this->key = $key;
        $this->maxAttempts = $maxAttempts;
        $this->decaySeconds = $decaySeconds;

        return $this;
    }

    /**
     * Get the throttle key for the given request.
     *
     * @param Request $request
     *
     * @return string
     */
    protected function throttleKey(Request $request)
    {
        return $this->key ?? Str::transliterate($request->ip());
    }
}
