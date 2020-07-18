<?php

namespace App\Http\Requests\Employee;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;

class CreateEmployeeReviewRequest extends FormRequest
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
            'company_id' => 'required|integer',
            'employee_id' => 'required|integer',
            'punctuality_score' => 'required|integer',
            'performance_score' => 'required|integer',
            'personality_score' => 'required|integer',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        Log::error($validator->getMessageBag());
        parent::failedValidation($validator);
    }
}
