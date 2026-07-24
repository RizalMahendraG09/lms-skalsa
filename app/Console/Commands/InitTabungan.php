<?php

namespace App\Console\Commands;

use App\Models\Tabungan;
use App\Models\User;
use Illuminate\Console\Command;

class InitTabungan extends Command
{
    protected $signature = 'tabungan:init';
    protected $description = 'Buat tabungan untuk semua siswa yang belum memiliki';

    public function handle()
    {
        $siswaTanpaTabungan = User::where('role', 'siswa')
            ->whereDoesntHave('tabungan')
            ->get();

        if ($siswaTanpaTabungan->isEmpty()) {
            $this->info('Semua siswa sudah memiliki tabungan.');
            return Command::SUCCESS;
        }

        $bar = $this->output->createProgressBar($siswaTanpaTabungan->count());
        $bar->start();

        foreach ($siswaTanpaTabungan as $siswa) {
            Tabungan::create(['siswa_id' => $siswa->id, 'saldo' => 0]);
            $bar->advance();
        }

        $bar->finish();
        $this->newLine();
        $this->info("Berhasil membuat {$siswaTanpaTabungan->count()} tabungan baru.");
        $this->warn('Jalankan ulang jika ada siswa baru ditambahkan.');

        return Command::SUCCESS;
    }
}
