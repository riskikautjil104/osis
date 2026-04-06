<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sambutan', function (Blueprint $table) {
            $table->id();
            $table->string('judul')->default('Sambutan Ketua OSIS');
            $table->text('konten');
            $table->string('foto')->nullable();
            $table->string('nama_ketua');
            $table->string('jabatan')->default('Ketua OSIS');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sambutan');
    }
};