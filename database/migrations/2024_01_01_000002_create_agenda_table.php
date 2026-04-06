<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('agenda', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->date('tanggal');
            $table->string('waktu')->nullable();
            $table->string('tempat');
            $table->text('deskripsi')->nullable();
            $table->enum('status', ['segera', 'berlangsung', 'selesai'])->default('segera');
            $table->enum('kategori', ['Akademik', 'Seni', 'Olahraga', 'Lingkungan', 'Sosial', 'Lainnya'])->default('Lainnya');
            $table->boolean('is_featured')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('agenda');
    }
};