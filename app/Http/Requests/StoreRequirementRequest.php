<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequirementRequest extends FormRequest
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
            'title' => 'required|alpha|max:50',
            'category_id' => 'required',
            'vendor_id' => 'required',
            'budget' => 'required|numeric',
            'fromDate' => 'required',
            'toDate' => 'required',
            'priority' => 'required',
            'proposal_document' => 'required|file|max:10000|mimes:xls,pdf,xlsx,doc,docx',
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
            'title.required' => 'Please enter title',
            'title.alpha' => 'Please enter alphabets in title',
            'category_id.required' => 'Please select category',
            'vendor_id.required' => 'Please select vendor',
            'budget.required' => 'Please enter budget',
            'budget.numeric' => 'Please enter numbers in budget',
            'fromDate.required' => 'Please select from date',
            'toDate.required' => 'Please select to date',
            'priority.required' => 'Please select priority',
            'proposal_document.required' => 'Please upload proposal document',
            'proposal_document.max' => 'Maximum file size to upload is 10MB',
        ];
    }
}
