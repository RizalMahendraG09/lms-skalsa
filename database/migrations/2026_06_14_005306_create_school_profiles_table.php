<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('school_profiles', function (Blueprint $table) {
            $table->id();
            $table->string('nama_sekolah');
            $table->string('logo')->nullable();
            $table->text('alamat');
            $table->string('email');
            $table->string('telepon');
            $table->string('website')->nullable();
            $table->text('visi');
            $table->text('misi');
            $table->text('sejarah');
            $table->string('kepala_sekolah');
            $table->string('foto_kepala_sekolah')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('school_profiles');
    }
};
