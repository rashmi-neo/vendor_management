<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BankDetailRequest extends FormRequest
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
            'bank_name'=> 'required|max:50',
            'account_holder_name'=> 'required|max:50',
            'account_number'=> 'required|max:50',
            'ifsc_code'=> 'required|max:50',
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
            'bank_name.required' => 'The Bank name is required',
            'account_holder_name.required' => 'The Account holder name is required',
            'account_number.required' => 'The Account number is required',
            'ifsc_code.required' => 'The IFSC code is required',
        ];
    }
}
