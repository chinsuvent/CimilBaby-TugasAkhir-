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
            $table->date('tanggal');                        
            $table->integer('slot_number')->nullable();    
            $table->integer('kapasitas')->default(10);     
            $table->integer('terisi')->default(0);         
            $table->enum('status', ['Tersedia', 'Tidak Tersedia'])->default('Tersedia');
            $table->timestamps();

            $table->index('tanggal'); 
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jadwal_layanans');
    }
};
