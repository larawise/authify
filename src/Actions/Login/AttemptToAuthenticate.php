<?php

namespace Larawise\Authify\Actions\Login;

use Illuminate\Contracts\Auth\Factory;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Larawise\Authify\Limiters\LoginLimiter;

class AttemptToAuthenticate
{
    /**
     * The auth factory implementation.
     *
     * @var Factory
     */
    protected $auth;

    /**
     * The login rate limiter instance.
     *
     * @var LoginLimiter
     */
    protected $limiter;

    /**
     * Create a new controller instance.
     *
     * @param Factory $auth
     * @param LoginLimiter $limiter
     *
     * @return void
     */
    public function __construct(Factory $auth, LoginLimiter $limiter)
    {
        $this->auth = $auth;
        $this->limiter = $limiter;
    }

    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @param callable $next
     *
     * @return mixed
     */
    public function handle($request, $next)
    {
        $guard = $this->auth->guard(
            $request->input('guard', 'web')
        );


    }

    /**
     * Throw a failed authentication validation exception.
     *
     * @param Request $request
     *
     * @return void
     * @throws ValidationException
     */
    protected function throwFailedAuthenticationException($request)
    {
        $this->limiter->increment($request);

    }
}
