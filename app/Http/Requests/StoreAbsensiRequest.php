<?php

namespace App\Http\Requests;

use App\Models\AbsensiSiswa;
use App\Models\Pertemuan;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreAbsensiRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'pertemuan_id' => ['required', 'exists:pertemuan,id'],
        ];
    }

    public function withValidator($validator): void
    {
        $validator->after(function ($validator) {
            $pertemuan = Pertemuan::with('mataPelajaran')->find($this->pertemuan_id);

            if (!$pertemuan) {
                return;
            }

            if ($pertemuan->status !== 'aktif') {
                $validator->errors()->add('pertemuan_id', 'Sesi absensi tidak aktif.');
                return;
            }

            $kelasId = Auth::user()->kelas_id;
            if ($pertemuan->mataPelajaran->kelas_id !== $kelasId) {
                $validator->errors()->add('pertemuan_id', 'Sesi absensi tidak tersedia untuk kelas Anda.');
                return;
            }

            $tanggal = $pertemuan->tanggal->format('Y-m-d');
            $mulai = Carbon::parse($tanggal . ' ' . $pertemuan->jam_mulai->format('H:i'));
            $selesai = Carbon::parse($tanggal . ' ' . $pertemuan->jam_selesai->format('H:i'));
            $now = Carbon::now();

            if (!$now->between($mulai, $selesai)) {
                $validator->errors()->add('pertemuan_id', 'Waktu absensi belum dimulai atau sudah berakhir.');
                return;
            }

            $exists = AbsensiSiswa::where('pertemuan_id', $pertemuan->id)
                ->where('siswa_id', Auth::id())
                ->exists();

            if ($exists) {
                $validator->errors()->add('pertemuan_id', 'Anda sudah melakukan absensi pada sesi ini.');
            }
        });
    }
}
