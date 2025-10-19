<?php

namespace Larawise\Authify\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Larawise\Authify\Authify;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'password' => Authify::passwordRules(),
        ];

        return [
            Authify::username() => 'required|string',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'email.required' => trans('authify.required_email'),
            'username.required' => trans('authify.required_username'),
            'phone.required' => trans('authify.required_phone'),
            'password.required' => trans('authify.required_password'),

            'email.invalid' => trans('authify.invalid_email'),
            'username.invalid' => trans('authify.invalid_username'),
            'phone.invalid' => trans('authify.invalid_phone'),
            'password.invalid' => trans('authify.invalid_password'),

            'email.not_exists' => trans('authify.required_email'),
            'username.not_exists' => trans('authify.required_username'),
            'phone.not_exists' => trans('authify.required_phone'),
        ];
    }
}
