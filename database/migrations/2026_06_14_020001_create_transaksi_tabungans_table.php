<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transaksi_tabungans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tabungan_id')->constrained()->cascadeOnDelete();
            $table->foreignId('admin_id')->constrained('users');
            $table->date('tanggal');
            $table->enum('jenis', ['setor', 'tarik']);
            $table->decimal('nominal', 15, 2);
            $table->string('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transaksi_tabungans');
    }
};
