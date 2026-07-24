<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;

class StoreSiswaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'nis' => ['nullable', 'string', 'max:50', 'unique:users,nis'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', Rules\Password::defaults()],
            'kelas_id' => ['nullable', 'exists:kelas,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama siswa wajib diisi.',
            'nis.unique' => 'NIS sudah digunakan.',
            'email.required' => 'Email wajib diisi.',
            'email.unique' => 'Email sudah digunakan.',
            'password.required' => 'Password wajib diisi.',
            'kelas_id.exists' => 'Kelas tidak ditemukan.',
        ];
    }
}
