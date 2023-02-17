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
        Schema::create('r_pesan_chat', function (Blueprint $table) {
            $table->string('rpc_room_id', 32)->primary();
            $table->string('rpc_pesan_terbaru', 128)->nullable();
            $table->string('rpc_waktu_kirim_terbaru', 16)->nullable();
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
        Schema::dropIfExists('r_pesan_chat');
    }
};
