<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StorePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $allwoed_roles = ['admin', 'posts.create'];

        $user_roles = explode(',', Auth::user()->roles);

        $match = array_intersect($allwoed_roles, $user_roles);


        return count($match) > 0;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|min:1|max:200',
            'body' => 'required|min:3',
            'thumbnail' => 'required|image|mimes:png,jpg',
            'post_status_id' => ['required', 'numeric', 'exists:post_statuses,id']
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'لابد من كتابة عنوان المقال',
            'title.min' => 'عنوان المقال لابد ان يتجاوز ال 10 احرف',
            'title.max' => 'عنوان المقال لابد ان لا يتجاوز ال 200 حرف',
            'post_status_id.required' => 'اختر حالة المقال'
        ];
    }
}
