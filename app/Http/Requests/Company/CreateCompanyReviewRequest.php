<?php

namespace App\Http\Requests\Company;

use Illuminate\Foundation\Http\FormRequest;

class CreateCompanyReviewRequest extends FormRequest
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
            'employee_id' => 'required|integer',
            'company_id' => 'required|integer',
            'score' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:8096',
        ];
    }
}
