<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSesiAbsensiRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'mata_pelajaran_id' => ['required', 'exists:mata_pelajarans,id'],
            'judul_pertemuan' => ['required', 'string', 'max:255'],
            'tanggal' => ['required', 'date'],
            'jam_mulai' => ['required', 'date_format:H:i'],
            'jam_selesai' => ['required', 'date_format:H:i', 'after:jam_mulai'],
            'status' => ['required', 'in:draft,aktif,selesai'],
        ];
    }

    public function messages(): array
    {
        return [
            'mata_pelajaran_id.required' => 'Mata pelajaran wajib dipilih.',
            'mata_pelajaran_id.exists' => 'Mata pelajaran tidak ditemukan.',
            'judul_pertemuan.required' => 'Judul pertemuan wajib diisi.',
            'tanggal.required' => 'Tanggal wajib diisi.',
            'jam_mulai.required' => 'Jam mulai wajib diisi.',
            'jam_selesai.required' => 'Jam selesai wajib diisi.',
            'jam_selesai.after' => 'Jam selesai harus setelah jam mulai.',
            'status.required' => 'Status wajib dipilih.',
            'status.in' => 'Status tidak valid.',
        ];
    }
}
