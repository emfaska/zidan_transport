<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('driver_wallets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Driver
            $table->decimal('balance', 14, 2)->default(0);           // Saldo saat ini
            $table->decimal('total_earned', 14, 2)->default(0);       // Total komisi sepanjang waktu
            $table->decimal('total_withdrawn', 14, 2)->default(0);    // Total yang sudah dicairkan
            $table->timestamps();

            $table->unique('user_id'); // Satu driver, satu dompet
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('driver_wallets');
    }
};
