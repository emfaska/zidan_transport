<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('withdrawal_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('driver_id')->constrained('users')->onDelete('cascade');
            $table->decimal('amount', 12, 2);               // Nominal yang diminta
            $table->string('nama_rekening');                 // Nama pemilik rekening
            $table->string('nama_bank');                     // Nama bank (BCA, BRI, dst)
            $table->string('no_rekening');                   // Nomor rekening
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->text('catatan_admin')->nullable();        // Catatan dari admin saat reject
            $table->timestamp('processed_at')->nullable();   // Kapan admin proses
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('withdrawal_requests');
    }
};
