<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreCommentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $allwoed_roles = ['admin', 'comment.create'];

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
            'post_id' => 'required|exists:posts,id',
            'comment' => 'required|min:2|max:200'
        ];
    }
}
