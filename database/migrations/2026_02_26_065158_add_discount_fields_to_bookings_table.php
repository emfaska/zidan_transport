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
            $table->foreignId('promo_id')->nullable()->constrained('promos')->onDelete('set null');
            $table->decimal('potongan_promo', 12, 2)->default(0);
            $table->decimal('total_akhir', 12, 2)->nullable(); // total_harga - potongan_promo
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropForeign(['promo_id']);
            $table->dropColumn(['promo_id', 'potongan_promo', 'total_akhir']);
        });
    }
};
