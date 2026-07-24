<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSoalEssayRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'pertanyaan' => ['required', 'string'],
            'poin' => ['required', 'integer', 'min:1'],
        ];
    }

    public function messages(): array
    {
        return [
            'pertanyaan.required' => 'Pertanyaan wajib diisi.',
            'poin.required' => 'Poin wajib diisi.',
            'poin.min' => 'Poin minimal 1.',
        ];
    }
}
