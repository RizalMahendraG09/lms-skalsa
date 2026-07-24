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
        Schema::create('jawaban_pg_siswa', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jawaban_siswa_id')->constrained('jawaban_siswa')->cascadeOnDelete();
            $table->foreignId('soal_pg_id')->constrained('soal_pg')->cascadeOnDelete();
            $table->enum('jawaban', ['A', 'B', 'C', 'D']);
            $table->boolean('is_correct')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jawaban_pg_siswa');
    }
};
