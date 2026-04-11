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
        Schema::create('profil_pengemudi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('foto_profil')->nullable();
            $table->string('nomor_sim')->nullable();
            $table->string('foto_ktp')->nullable();
            $table->string('foto_sim')->nullable();
            $table->text('alamat_domisili')->nullable();
            $table->enum('status_driver', ['available', 'on_duty', 'off'])->default('off');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profil_pengemudi');
    }
};
