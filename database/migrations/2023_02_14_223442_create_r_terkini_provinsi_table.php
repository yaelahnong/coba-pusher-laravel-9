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
        Schema::create('r_terkini_provinsi', function (Blueprint $table) {
            $table->smallIncrements('rtp_id');
            $table->unsignedSmallInteger('rtp_kp_id');
            $table->char('rtp_kp_kode', 4);
            $table->unsignedTinyInteger('rtp_mp_id');
            $table->char('rtp_mp_kode', 3);
            $table->unsignedInteger('rtp_jumlah_suara');
            $table->char('rtp_bulan', 2);
            $table->char('rtp_tahun', 4);
            $table->timestamps();
            $table->foreign('rtp_kp_id')->references('kp_id')->on('kandidat_pemilihan');
            $table->foreign('rtp_mp_id')->references('mp_id')->on('m_provinsi');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('r_terkini_provinsi');
    }
};
