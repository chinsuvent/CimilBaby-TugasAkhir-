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
        Schema::create('anaks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('penggunas_id')->constrained('penggunas')->onDelete('cascade');
            $table->string('nama_anak');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->enum('jenis_kelamin', ['Laki-laki','Perempuan']);
            $table->integer('usia');
            $table->string('alergi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anaks');
    }
};