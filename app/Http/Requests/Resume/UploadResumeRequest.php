<?php

namespace App\Http\Requests\Resume;

use Illuminate\Foundation\Http\FormRequest;

class UploadResumeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'resume' => ['required', 'file', 'mimes:pdf', 'max:10240'],
            'title' => ['sometimes', 'string', 'max:255'],
        ];
    }
}
