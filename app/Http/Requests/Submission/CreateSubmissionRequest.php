<?php

namespace App\Http\Requests\Submission;

use App\Http\Trait\RequestExceptionTrait;
use Illuminate\Foundation\Http\FormRequest;

class CreateSubmissionRequest extends FormRequest
{
    use RequestExceptionTrait;

    /**
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ];
    }

    /**
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'name' => [
                'required' => ':attribute is required',
                'string' => ':attribute must be a string',
                'max' => ':attribute must not exceed :max characters',
            ],
            'email' => [
                'required' => ':attribute is required',
                'email' => ':attribute must be a valid email address',
                'max' => ':attribute must not exceed :max characters',
            ],
            'message' => [
                'required' => ':attribute is required',
                'string' => ':attribute must be a string',
            ],
        ];
    }
}
