<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;

class UpdateSiswaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'nis' => ['nullable', 'string', 'max:50', Rule::unique('users', 'nis')->ignore($this->route('siswa'))],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique('users', 'email')->ignore($this->route('siswa'))],
            'password' => ['nullable', Rules\Password::defaults()],
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
            'kelas_id.exists' => 'Kelas tidak ditemukan.',
        ];
    }
}
