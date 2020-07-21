<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SupportContactRequest extends FormRequest
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
            'name'=> 'required|max:50',
            'contact_number'=> 'required|min:10|max:15',
            'email_address' => 'required|unique:vms_support_contact_details,email'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
    */
    public function messages()
    {
        return [
            'name.required' => 'Contact person  is required',
            'contact_number.required' => 'Phone number  is required',
            'email_address.required' => 'Email address  is required',
            'email_address.email' => 'Please enter valid email',
        ];
    }
}
