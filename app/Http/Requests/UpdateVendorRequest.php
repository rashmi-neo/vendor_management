<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateVendorRequest extends FormRequest
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
    public function rules(Request $request)
    {
        return [
            'email' => 'required|email|unique:users,email,'.$request->user_id,         
            'first_name' => 'required|alpha|max:50',
            'middle_name' => 'max:50',
            'last_name' => 'required|alpha|max:50',
            'mobile_number' => 'required|min:10|max:12',
            'company_name' => 'required|max:50',
            'address' => 'required|max:200',
            'profile_image' => 'image|mimes:jpeg,png,jpg|max:1024',
            'category' => 'required',
            'state' => 'required|max:20',
            'city' => 'required|max:20',
            'pincode' => 'required|min:6|max:10',
            'contact_number' => 'required|min:10|max:12',
            'fax' => 'max:20',
            'website' => 'max:20|nullable|url',

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
            'email.required' => 'Please enter email',
            'first_name.required' => 'Please enter first name',
            'last_name.required' => 'Please enter last name',
            'mobile_number.required' => 'Please enter mobile number',
            'company_name.required' => 'Please enter company name',
            'address.required' => 'Please enter address',
            'category.required' => 'Please select category',
            'state.required' => 'Please enter state',
            'city.required' => 'Please enter city',
            'pincode.required' => 'Please enter pincode',
            'contact_number.required' => 'Please enter contact number',
            'fax.required' => 'Please enter fax',
            'website.required' => 'Please enter website url',
        ];
    }
}
