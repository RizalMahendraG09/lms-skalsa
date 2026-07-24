<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTugasRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'mata_pelajaran_id' => ['required', 'exists:mata_pelajarans,id'],
            'judul' => ['required', 'string', 'max:255'],
            'deskripsi' => ['nullable', 'string'],
            'deadline' => ['required', 'date', 'after:now'],
        ];
    }

    public function messages(): array
    {
        return [
            'mata_pelajaran_id.required' => 'Mata pelajaran wajib dipilih.',
            'mata_pelajaran_id.exists' => 'Mata pelajaran tidak ditemukan.',
            'judul.required' => 'Judul tugas wajib diisi.',
            'deadline.required' => 'Deadline wajib diisi.',
            'deadline.after' => 'Deadline harus setelah waktu sekarang.',
        ];
    }
}
