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
            $table->decimal('harga_paket_pp', 12, 2)->nullable()->after('harga_paket')->comment('Harga khusus Pulang Pergi');
        });

        Schema::table('bookings', function (Blueprint $table) {
            $table->enum('tipe_perjalanan', ['one_way', 'round_trip'])->default('one_way')->after('rute_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rutes', function (Blueprint $table) {
            $table->dropColumn('harga_paket_pp');
        });

        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn('tipe_perjalanan');
        });
    }
};
