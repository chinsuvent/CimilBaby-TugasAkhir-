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
        $table->foreignId('anaks_id')->constrained('anaks')->onDelete('cascade');
        $table->foreignId('layanans_id')->constrained('layanans')->onDelete('cascade');
        $table->integer('kapasitas')->default(10);  
        $table->integer('terisi')->default(0);     
        $table->enum('status', ['Tersedia', 'Tidak Tersedia', 'Selesai', 'Dibatalkan'])->default('Tersedia');
        $table->timestamps();
    });

    }

    public function down(): void
    {
        Schema::dropIfExists('jadwal_layanans');
    }
};
