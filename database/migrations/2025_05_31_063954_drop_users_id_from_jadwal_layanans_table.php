<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('jadwal_layanans', function (Blueprint $table) {
        // Hapus foreign key constraint dulu
        $table->dropForeign('jadwal_layanans_users_id_foreign');
        
        // Baru hapus kolom
        $table->dropColumn('users_id');
    });
}

public function down()
{
    Schema::table('jadwal_layanans', function (Blueprint $table) {
        $table->unsignedBigInteger('users_id')->nullable();

        // Tambah foreign key lagi saat rollback (jika perlu)
        $table->foreign('users_id')->references('id')->on('users');
    });
}


};
