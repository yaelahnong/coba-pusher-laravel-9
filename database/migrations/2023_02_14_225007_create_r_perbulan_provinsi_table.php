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
        Schema::create('r_perbulan_provinsi', function (Blueprint $table) {
            $table->smallIncrements('rpp_id');
            $table->unsignedSmallInteger('rpp_kp_id');
            $table->char('rpp_kp_kode', 4);
            $table->unsignedTinyInteger('rpp_mp_id');
            $table->char('rpp_mp_kode', 3);
            $table->unsignedInteger('rpp_jumlah_suara');
            $table->char('rpp_bulan', 2);
            $table->char('rpp_tahun', 4);
            $table->timestamps();
            $table->foreign('rpp_kp_id')->references('kp_id')->on('kandidat_pemilihan');
            $table->foreign('rpp_mp_id')->references('mp_id')->on('m_provinsi');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('r_perbulan_provinsi');
    }
};
