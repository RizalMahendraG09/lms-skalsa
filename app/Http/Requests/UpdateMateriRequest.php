<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMateriRequest extends FormRequest
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
            'file_pdf' => ['nullable', 'file', 'mimes:pdf', 'max:10240'],
        ];
    }

    public function messages(): array
    {
        return [
            'mata_pelajaran_id.required' => 'Mata pelajaran wajib dipilih.',
            'mata_pelajaran_id.exists' => 'Mata pelajaran tidak ditemukan.',
            'judul.required' => 'Judul materi wajib diisi.',
            'file_pdf.mimes' => 'File harus berupa PDF.',
            'file_pdf.max' => 'File maksimal 10MB.',
        ];
    }
}
