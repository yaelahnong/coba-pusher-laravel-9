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
        Schema::create('kandidat_pemilihan', function (Blueprint $table) {
            $table->smallIncrements('kp_id');
            $table->char('kp_kode', 4);
            $table->string('kp_nama', 128);
            $table->string('kp_partai', 32);
            $table->string('kp_foto_capres', 128);
            $table->string('kp_foto_cawapres', 128);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kandidat_pemilihan');
    }
};
