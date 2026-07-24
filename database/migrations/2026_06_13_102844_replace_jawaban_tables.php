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
        Schema::dropIfExists('jawaban_pg_siswa');
        Schema::dropIfExists('jawaban_essay_siswa');

        Schema::create('jawaban_pg', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jawaban_siswa_id')->constrained('jawaban_siswa')->cascadeOnDelete();
            $table->foreignId('soal_pg_id')->constrained('soal_pg')->cascadeOnDelete();
            $table->enum('jawaban_siswa', ['A', 'B', 'C', 'D']);
            $table->boolean('benar')->default(false);
            $table->integer('poin_didapat')->default(0);
            $table->timestamps();
        });

        Schema::create('jawaban_essay', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jawaban_siswa_id')->constrained('jawaban_siswa')->cascadeOnDelete();
            $table->foreignId('soal_essay_id')->constrained('soal_essay')->cascadeOnDelete();
            $table->text('jawaban');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jawaban_essay');
        Schema::dropIfExists('jawaban_pg');

        Schema::create('jawaban_pg_siswa', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jawaban_siswa_id')->constrained('jawaban_siswa')->cascadeOnDelete();
            $table->foreignId('soal_pg_id')->constrained('soal_pg')->cascadeOnDelete();
            $table->enum('jawaban', ['A', 'B', 'C', 'D']);
            $table->boolean('is_correct')->default(false);
            $table->timestamps();
        });

        Schema::create('jawaban_essay_siswa', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jawaban_siswa_id')->constrained('jawaban_siswa')->cascadeOnDelete();
            $table->foreignId('soal_essay_id')->constrained('soal_essay')->cascadeOnDelete();
            $table->text('jawaban');
            $table->timestamps();
        });
    }
};
