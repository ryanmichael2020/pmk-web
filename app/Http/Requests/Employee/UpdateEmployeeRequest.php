<?php

namespace App\Http\Requests\Employee;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;

class UpdateEmployeeRequest extends FormRequest
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
            'age' => 'required|string|max:2',
            'address' => 'required|string|max:512',
            'mobile' => 'required|string|max:16',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        Log::error($validator->getMessageBag());
        parent::failedValidation($validator);
    }
}
