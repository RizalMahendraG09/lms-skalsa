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
        Schema::create('jawaban_siswa', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siswa_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('tugas_id')->constrained()->cascadeOnDelete();
            $table->integer('nilai_pg')->nullable();
            $table->integer('nilai_essay')->nullable();
            $table->integer('nilai_akhir')->nullable();
            $table->enum('status', ['draft', 'submitted', 'dinilai'])->default('draft');
            $table->dateTime('submitted_at')->nullable();
            $table->timestamps();

            $table->unique(['siswa_id', 'tugas_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jawaban_siswa');
    }
};
