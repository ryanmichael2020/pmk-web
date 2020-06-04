<?php

namespace App\Http\Requests\Core\Employee;

use Illuminate\Foundation\Http\FormRequest;

class CreateEmployeeEducationRequest extends FormRequest
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
            'employee_id' => 'integer',
            'education_level_id' => 'required|integer',
            'school' => 'required|string|max:128',
            'start_year' => 'required|string|max:4',
            'end_year' => 'nullable|string|max:4',
        ];
    }
}
