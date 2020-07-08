<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class VendorRequest extends FormRequest
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
            'email' => 'required',Rule::unique('users')->ignore($this->id),         
            'first_name' => 'required|max:50',
            'middle_name' => 'max:50',
            'last_name' => 'required|max:50',
            'phone_number' => 'required|max:20',
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
            'email.required' => 'Please enter email',
            'first_name.required' => 'Please enter first name',
            'last_name.required' => 'Please enter last name',
            'mobile_number.required' => 'Please enter mobile number',
        ];
    }
}
