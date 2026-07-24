<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTarikRequest extends FormRequest
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

    public function withValidator($validator): void
    {
        $validator->after(function ($validator) {
            $tabungan = $this->route('tabungan');
            $nominal = (float) $this->input('nominal');

            if ($nominal > (float) $tabungan->saldo) {
                $validator->errors()->add('nominal', 'Saldo tidak mencukupi. Saldo saat ini: Rp ' . number_format($tabungan->saldo, 0, ',', '.'));
            }
        });
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
