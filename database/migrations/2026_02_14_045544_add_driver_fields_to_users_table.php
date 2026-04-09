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
        Schema::table('users', function (Blueprint $table) {
            // Driver specific fields only (no_telepon and alamat already exist)
            $table->string('foto_profil')->nullable()->after('alamat');
            $table->string('nomor_sim')->nullable()->after('foto_profil');
            $table->enum('status_driver', ['available', 'on_duty', 'off'])->nullable()->after('nomor_sim');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['foto_profil', 'nomor_sim', 'status_driver']);
        });
    }
};
