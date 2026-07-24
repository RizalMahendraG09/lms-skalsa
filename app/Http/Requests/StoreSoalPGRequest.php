<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSoalPGRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'pertanyaan' => ['required', 'string'],
            'opsi_a' => ['required', 'string', 'max:255'],
            'opsi_b' => ['required', 'string', 'max:255'],
            'opsi_c' => ['required', 'string', 'max:255'],
            'opsi_d' => ['required', 'string', 'max:255'],
            'jawaban_benar' => ['required', 'in:A,B,C,D'],
            'poin' => ['required', 'integer', 'min:1'],
        ];
    }

    public function messages(): array
    {
        return [
            'pertanyaan.required' => 'Pertanyaan wajib diisi.',
            'opsi_a.required' => 'Opsi A wajib diisi.',
            'opsi_b.required' => 'Opsi B wajib diisi.',
            'opsi_c.required' => 'Opsi C wajib diisi.',
            'opsi_d.required' => 'Opsi D wajib diisi.',
            'jawaban_benar.required' => 'Jawaban benar wajib dipilih.',
            'jawaban_benar.in' => 'Jawaban benar harus A, B, C, atau D.',
            'poin.required' => 'Poin wajib diisi.',
            'poin.min' => 'Poin minimal 1.',
        ];
    }
}
