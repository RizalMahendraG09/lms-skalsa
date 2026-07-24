<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMataPelajaranRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nama_mapel' => ['required', 'string', 'max:255'],
            'guru_id' => ['required', 'exists:users,id'],
            'kelas_id' => ['required', 'exists:kelas,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'nama_mapel.required' => 'Nama mata pelajaran wajib diisi.',
            'guru_id.required' => 'Guru pengajar wajib dipilih.',
            'guru_id.exists' => 'Guru tidak ditemukan.',
            'kelas_id.required' => 'Kelas wajib dipilih.',
            'kelas_id.exists' => 'Kelas tidak ditemukan.',
        ];
    }
}
