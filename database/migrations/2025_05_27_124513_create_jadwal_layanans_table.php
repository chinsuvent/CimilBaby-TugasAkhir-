<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jadwal_layanans', function (Blueprint $table) {
            $table->id();

            // Foreign keys
            $table->foreignId('anaks_id')->constrained('anaks')->onDelete('cascade');
            // $table->foreignId('users_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('reservasis_id')->constrained('reservasis')->onDelete('cascade');
            $table->foreignId('layanans_id')->constrained('layanans')->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jadwal_layanans');
    }
};
