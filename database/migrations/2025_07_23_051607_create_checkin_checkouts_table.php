<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('checkin_checkouts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('reservasis_id');
            $table->timestamp('waktu_checkin')->nullable();
            $table->timestamp('waktu_checkout')->nullable();
            $table->timestamps();

            $table->foreign('reservasis_id')->references('id')->on('reservasis')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('checkin_checkouts');
    }
};
