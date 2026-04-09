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
        Schema::create('armadas', function (Blueprint $table) {
            $table->id();
            $table->string('nama'); // Toyota HiAce Premium
            $table->string('jenis'); // Minibus, MPV, Sedan
            $table->integer('kapasitas'); // Jumlah penumpang
            $table->year('tahun')->nullable(); // Tahun kendaraan
            $table->string('plat_nomor')->unique();
            $table->enum('status', ['tersedia', 'maintenance', 'terpakai'])->default('tersedia');
            $table->string('foto')->nullable(); // Path to image
            $table->text('spesifikasi')->nullable(); // AC, Audio, dll
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('armadas');
    }
};
