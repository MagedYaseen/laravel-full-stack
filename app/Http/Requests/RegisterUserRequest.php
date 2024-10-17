<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // dd(config('app.allow_register'));

        // dd(env('APP_ALLOW_REGISTER'));

        return config('app.allow_register');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|min:3|max:40|alpha',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|alpha_num|min:8|max:20|confirmed',
            'photo' => 'required',
        ];
    }
}
