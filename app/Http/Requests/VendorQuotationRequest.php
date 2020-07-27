<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Session;

class VendorQuotationRequest extends FormRequest
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
        
        

        if($request->fromDate<=date('Y-m-d') && date('Y-m-d') <= $request->toDate){
            return [
                'quotation' => 'required|file|max:150|mimes:xls,pdf,xlsx',
            ];
        }else{
            return [Session::put('error', 'you cant add quotation')];
        }

        
        
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
    */
    public function messages()
    {
        return [
            'quotation.required' => 'The Quotation is required',
            'toDate.before' => 'The Quotation cant',

        ];
    }
}
