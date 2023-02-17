<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('r_terkini_seluruh_indonesia', function (Blueprint $table) {
            $table->smallIncrements('rtsi_id');
            $table->unsignedSmallInteger('rtsi_kp_id');
            $table->char('rtsi_kp_kode', 4);
            $table->unsignedInteger('rtsi_jumlah_suara');
            $table->char('rtsi_bulan', 2);
            $table->char('rtsi_tahun', 4);
            $table->timestamps();
            $table->foreign('rtsi_kp_id')->references('kp_id')->on('kandidat_pemilihan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('r_terkini_seluruh_indonesia');
    }
};
