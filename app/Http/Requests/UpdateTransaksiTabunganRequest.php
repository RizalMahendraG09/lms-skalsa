<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTransaksiTabunganRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'tanggal' => ['required', 'date'],
            'nominal' => ['required', 'numeric', 'min:1'],
            'keterangan' => ['nullable', 'string', 'max:255'],
        ];
    }

    public function messages(): array
    {
        return [
            'tanggal.required' => 'Tanggal wajib diisi.',
            'tanggal.date' => 'Format tanggal tidak valid.',
            'nominal.required' => 'Nominal wajib diisi.',
            'nominal.numeric' => 'Nominal harus berupa angka.',
            'nominal.min' => 'Nominal harus lebih dari 0.',
            'keterangan.max' => 'Keterangan maksimal 255 karakter.',
        ];
    }
}
