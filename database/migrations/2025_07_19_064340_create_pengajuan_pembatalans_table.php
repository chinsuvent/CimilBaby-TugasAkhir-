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
        Schema::create('pengajuan_pembatalans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reservasis_id')->constrained('reservasis')->onDelete('cascade');
            $table->text('alasan')->nullable();
            $table->enum('status', ['Menunggu', 'Disetujui', 'Ditolak'])->default('Menunggu');
            $table->timestamp('tanggal_pengajuan')->useCurrent();
            $table->timestamp('tanggal_dikonfirmasi')->nullable();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuan_pembatalans');
    }
};
