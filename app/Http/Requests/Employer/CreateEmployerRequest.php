<?php

namespace App\Http\Requests\Employer;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;

class CreateEmployerRequest extends FormRequest
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
            'email' => 'required|email|max:255',
            'password' => 'required|string|max:32',
            'verify_password' => 'required|string|max:32',
            'first_name' => 'required|string|max:64',
            'last_name' => 'required|string|max:32',
            'sex' => 'required|string|max:16',
            'company_id' => 'required|integer',
            'image' => 'image|mimes:jpeg,png,jpg',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        Log::error($validator->getMessageBag());
        parent::failedValidation($validator);
    }
}
