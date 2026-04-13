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
        Schema::table('rutes', function (Blueprint $table) {
            // Kota/Kabupaten asal (titik keberangkatan)
            $table->string('kota_asal')->nullable()->after('lokasi_awal');
            // Kota/Kabupaten tujuan
            $table->string('kota_tujuan')->nullable()->after('tujuan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rutes', function (Blueprint $table) {
            $table->dropColumn(['kota_asal', 'kota_tujuan']);
        });
    }
};
