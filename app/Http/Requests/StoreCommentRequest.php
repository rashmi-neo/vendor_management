<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCommentRequest extends FormRequest
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
        return [
            'comment' => 'required|min:2|max:1000',
        ];
    }
        /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages()
    {
        return [
            'comment.required' => 'Please enter comment',
            'comment.min' => 'Minimum limit is 2 characters',
            'comment.max' => 'Maximum limit is 1000 characters',
        ];
    }
}
