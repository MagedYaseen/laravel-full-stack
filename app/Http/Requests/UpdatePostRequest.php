<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdatePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $allwoed_roles = ['admin', 'posts.create', 'posts.editor'];

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
            'title' => 'min:1|max:200',
            'body' => 'min:3',
            'thumbnail' => 'image|mimes:png,jpg',
            'post_status_id' => ['numeric', 'exists:post_statuses,id']
        ];
    }
}
