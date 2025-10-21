<?php

namespace Larawise\Authify\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Larawise\Authify\Authify;
use Symfony\Component\HttpFoundation\Request as SymfonyRequest;

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
class AuthifyRequest extends FormRequest
{
    /**
     * Get the user making the request.
     *
     * @param string|null $guard
     *
     * @return mixed
     */
    public function user($guard = null)
    {
        $guard ??= config('authify.guard', 'web');

        return parent::user($guard);
    }

    /**
     * Create an Illuminate request from a Symfony instance.
     *
     * @param SymfonyRequest $request
     *
     * @return static
     */
    public static function createFromBase(SymfonyRequest $request)
    {
        $newRequest = parent::createFromBase($request);

        if ($request instanceof Request) {
            $newRequest->setUserResolver($request->getUserResolver());
        }

        return $newRequest;
    }
}
