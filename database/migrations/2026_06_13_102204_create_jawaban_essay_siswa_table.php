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
        Schema::create('jawaban_essay_siswa', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jawaban_siswa_id')->constrained('jawaban_siswa')->cascadeOnDelete();
            $table->foreignId('soal_essay_id')->constrained('soal_essay')->cascadeOnDelete();
            $table->text('jawaban');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jawaban_essay_siswa');
    }
};
