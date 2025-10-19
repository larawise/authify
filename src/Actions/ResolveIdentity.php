<?php

namespace Larawise\Authify\Actions;

use Larawise\Authify\Authify;

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
class ResolveIdentity
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
        foreach (Authify::enabledIdentityFields() as $field) {
            if ($request->has($field)) {
                $request->merge([
                    $field => Authify::identityNormalize($field, $request->input($field)),
                ]);
            }
        }

        return $next($request);
    }
}
