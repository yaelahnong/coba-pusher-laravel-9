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
        Schema::create('r_perbulan_seluruh_indonesia', function (Blueprint $table) {
            $table->smallIncrements('rpsi_id');
            $table->unsignedSmallInteger('rpsi_kp_id');
            $table->char('rpsi_kp_kode', 4);
            $table->unsignedInteger('rpsi_jumlah_suara');
            $table->char('rpsi_bulan', 2);
            $table->char('rpsi_tahun', 4);
            $table->timestamps();
            $table->foreign('rpsi_kp_id')->references('kp_id')->on('kandidat_pemilihan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('r_perbulan_seluruh_indonesia');
    }
};
