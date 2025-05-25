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
        Schema::create('reservasis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('anaks_id')->constrained('anaks')->onDelete('cascade');
            $table->foreignId('penggunas_id')->constrained('penggunas')->onDelete('cascade');
            $table->foreignId('layanans_id')->constrained('layanans')->onDelete('cascade');
            $table->date('tgl_masuk');
            $table->date('tgl_keluar');
            $table->decimal('total',10,2);
            $table->string('metode_pembayaran');
            $table->enum('status', ['Pending', 'Diterima', 'Ditolak']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservasis');
    }
};