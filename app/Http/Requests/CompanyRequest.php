<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
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
            'company_name' => 'required|max:50',
            'company_address' => 'required|max:200',
            'state' => 'required|regex:/^[\pL\s\-]+$/u|max:50',
            'city' => 'required|regex:/^[\pL\s\-]+$/u|max:50',
            'pincode' => 'required|min:6|max:10',
            'contact_number' => 'required|min:10|max:12',
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
            'company_name.required' => 'Please enter company name',
            'address.required' => 'Please enter address',
            'state.required' => 'Please enter state',
            'city.required' => 'Please enter city',
            'pincode.required' => 'Please enter pincode',
            'contact_number.required' => 'Please enter contact number',
        ];
    }
}
