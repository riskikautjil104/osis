<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('proker', function (Blueprint $table) {
            $table->id();
            $table->string('nama_program');
            $table->string('slug')->unique();
            $table->string('kategori');
            $table->text('deskripsi');
            $table->text('tujuan')->nullable();
            $table->text('sasaran')->nullable();
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai')->nullable();
            $table->string('tempat')->nullable();
            $table->string('penanggung_jawab');
            $table->string('foto')->nullable();
            $table->integer('progress')->default(0); // 0-100 persen
            $table->enum('status', ['rencana', 'berjalan', 'selesai', 'tertunda'])->default('rencana');
            $table->string('anggaran')->nullable();
            $table->json('dokumentasi')->nullable(); // multiple foto
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_published')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('proker');
    }
};