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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('kode_booking')->unique(); // BOOK-20240214-001
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Pelanggan
            $table->foreignId('rute_id')->constrained()->onDelete('cascade');
            $table->date('tanggal_berangkat');
            $table->time('waktu_jemput');
            $table->integer('jumlah_penumpang');
            $table->boolean('include_tol')->default(false);
            $table->decimal('harga_paket', 12, 2); // Snapshot harga saat booking
            $table->decimal('harga_tol', 10, 2)->nullable(); // Snapshot harga tol
            $table->decimal('total_harga', 12, 2); // harga_paket + (harga_tol if include_tol)
            $table->enum('status', ['pending', 'confirmed', 'on_progress', 'completed', 'cancelled'])->default('pending');
            $table->foreignId('driver_id')->nullable()->constrained('users')->onDelete('set null'); // Assigned driver
            $table->text('catatan_customer')->nullable();
            $table->text('catatan_admin')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
