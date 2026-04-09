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
        Schema::table('bookings', function (Blueprint $table) {
            $table->enum('metode_pembayaran', ['cash', 'transfer', 'qris'])->nullable()->after('status');
            $table->enum('tipe_pembayaran', ['dp', 'lunas'])->nullable()->after('metode_pembayaran');
            $table->enum('status_pembayaran', ['belum_bayar', 'dp_dibayar', 'lunas'])->default('belum_bayar')->after('tipe_pembayaran');
            $table->decimal('jumlah_bayar', 12, 2)->default(0)->after('status_pembayaran');
            $table->string('bukti_pembayaran')->nullable()->after('jumlah_bayar');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn(['metode_pembayaran', 'tipe_pembayaran', 'status_pembayaran', 'jumlah_bayar', 'bukti_pembayaran']);
        });
    }
};
