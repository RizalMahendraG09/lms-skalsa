<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreKelasRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nama_kelas' => ['required', 'string', 'max:255', 'unique:kelas,nama_kelas'],
        ];
    }

    public function messages(): array
    {
        return [
            'nama_kelas.required' => 'Nama kelas wajib diisi.',
            'nama_kelas.unique' => 'Nama kelas sudah ada.',
        ];
    }
}
