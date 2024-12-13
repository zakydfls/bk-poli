<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldDaftarPolis extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table('daftar_polis', function (Blueprint $table) {
            $table->enum('status_antrian', ['menunggu_dipanggil', 'dipanggil', 'sudah_muncul'])->default('menunggu_dipanggil');
            $table->timestamp('dipanggil_pada')->nullable();
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
