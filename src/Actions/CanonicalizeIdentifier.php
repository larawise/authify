<?php

namespace Laravel\Fortify\Actions;

use Larawise\Authify\Authify;

class CanonicalizeUsername
{
    /**
     * Handle the incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param callable $next
     *
     * @return mixed
     */
    public function handle($request, $next)
    {
        if ($request->has(Authify::username())) {
            $request->merge([
                Fortify::username() => Str::lower($request->{Fortify::username()}),
            ]);
        }

        return $next($request);
    }
}
