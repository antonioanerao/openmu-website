<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'loginName' => 'required',
            'password' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'loginName.required' => 'Your login is required',
            'password.required' => 'Your password is required'
        ];
    }
}
