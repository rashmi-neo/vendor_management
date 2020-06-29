<?php

namespace App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;

class VendorStoreRequest extends FormRequest
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
        
            // dd($request->all());
            
        return [
           'email' => 'required|email|unique:users',
            'first_name' => 'required',
            'middle_name' => 'required',
            'last_name' => 'required',
            'mobile_number' => 'required|integer',
            'profile_image' => 'required',
            'company_name' => 'required',
            'address' => 'required',
            'state' => 'required',
            'city' => 'required',
            'pincode' => 'required|integer',
            'contact_number' => 'required|integer',
            'fax' => 'required',
            'website' => 'required',
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
            'email.unique' => 'Email Already exist',
            'first_name.required' => 'Please enter first name',
            'middle_name.required' => 'Please enter middle name',
            'last_name.required' => 'Please enter last name',
            'mobile_number.required' => 'Please enter mobile number',
            'profile_image.required' => 'Please upload profile image',
            'company_name.required' => 'Please enter company name',
            'address.required' => 'Please enter address',
            'state.required' => 'Please enter state',
            'city.required' => 'Please enter city',
            'pincode.required' => 'Please enter pincode',
            'contact_number.required' => 'Please enter contact number',
            'fax.required' => 'Please enter fax',
            'website.required' => 'Please enter website url',
        ];
    }
}
