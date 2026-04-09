<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // For MySQL/MariaDB, changing enum requires re-defining the column
        Schema::table('bookings', function (Blueprint $table) {
            $table->enum('metode_pembayaran', ['cash', 'transfer', 'qris', 'midtrans'])->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->enum('metode_pembayaran', ['cash', 'transfer', 'qris'])->nullable()->change();
        });
    }
};
