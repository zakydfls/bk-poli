<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyDaftarPolis extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table('daftar_polis', function (Blueprint $table) {
            $table->foreign('id_pasien')->references('id')->on('pasiens')->onDelete('cascade');
            $table->foreign('id_jadwal')->references('id')->on('jadwal_periksas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
