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
            $table->dropColumn([
                'foto_profil',
                'nomor_sim',
                'foto_ktp',
                'foto_sim',
                'alamat_domisili',
                'status_driver',
                // Keep rejection_note for any role
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('foto_profil')->nullable();
            $table->string('nomor_sim')->nullable();
            $table->enum('status_driver', ['available', 'on_duty', 'off'])->nullable();
            $table->string('foto_ktp')->nullable();
            $table->string('foto_sim')->nullable();
            $table->text('alamat_domisili')->nullable();
        });
    }
};
