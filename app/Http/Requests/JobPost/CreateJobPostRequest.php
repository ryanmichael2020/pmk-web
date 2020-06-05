<?php

namespace App\Http\Requests\JobPost;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;

class CreateJobPostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'position' => 'required|string|max:128',
            'description' => 'required|string|max:8096',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        Log::error($validator->getMessageBag());
        parent::failedValidation($validator);
    }
}
