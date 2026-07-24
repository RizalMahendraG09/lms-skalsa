<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('absensi_siswa', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pertemuan_id')->constrained('pertemuan')->cascadeOnDelete();
            $table->foreignId('siswa_id')->constrained('users')->cascadeOnDelete();
            $table->enum('status', ['hadir', 'terlambat', 'tidak_hadir'])->default('tidak_hadir');
            $table->timestamp('waktu_absen')->nullable();
            $table->timestamps();

            $table->unique(['pertemuan_id', 'siswa_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absensi_siswa');
    }
};
