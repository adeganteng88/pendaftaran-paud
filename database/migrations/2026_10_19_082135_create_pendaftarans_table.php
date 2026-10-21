<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pendaftarans', function (Blueprint $table) {
            $table->id('id_pendaftaran');
            $table->foreignId('id_wali')->constrained('walis', 'id_wali')->onDelete('cascade');
            $table->foreignId('id_user')->nullable()->constrained('users', 'id_user')->onDelete('set null');
            $table->string('nama_siswa');
            $table->string('nik', 16);
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->text('alamat');
            $table->date('tanggal_daftar');
            $table->string('berkas_persyaratan')->nullable();
            $table->enum('status_validasi', ['pending', 'valid', 'tidak_valid'])->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pendaftarans');
    }
};