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
        Schema::create('rutes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('layanan_id')->constrained('layanans')->onDelete('cascade');
            $table->string('nama_rute'); // Kediri - Surabaya
            $table->string('lokasi_awal');
            $table->string('tujuan');
            $table->foreignId('armada_id')->constrained('armadas')->onDelete('cascade');
            $table->decimal('harga_paket', 12, 2); // Include driver + BBM
            $table->decimal('harga_tol', 10, 2)->nullable(); // Harga tol jika ada
            $table->string('durasi_estimasi')->nullable(); // "3 jam"
            $table->integer('jarak_km')->nullable();
            $table->text('catatan')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rutes');
    }
};
