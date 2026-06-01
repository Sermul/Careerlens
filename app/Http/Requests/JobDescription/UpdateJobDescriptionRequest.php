<?php

namespace App\Http\Requests\JobDescription;

use Illuminate\Foundation\Http\FormRequest;

class UpdateJobDescriptionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['sometimes', 'string', 'max:255'],
            'content' => ['sometimes', 'string'],
            'metadata' => ['sometimes', 'array'],
        ];
    }
}
