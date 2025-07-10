<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengajuanPembatalanTable extends Migration
{
    public function up()
    {
        Schema::create('pengajuan_pembatalan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('reservasis_id')->constrained()->onDelete('cascade');
            $table->text('alasan');
            $table->enum('status', ['Menunggu', 'Disetujui', 'Ditolak'])->default('Menunggu');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pengajuan_pembatalan');
    }
}
