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
        Schema::create('pesan_chat', function (Blueprint $table) {
            $table->increments('pc_id');
            $table->string('pc_room_id', 32);
            $table->char('pc_user_initial', 2);
            $table->string('pc_nama', 128);
            $table->string('pc_pesan', 128);
            $table->string('pc_waktu_kirim', 16);
            $table->timestamps();
            $table->foreign('pc_room_id')->references('rpc_room_id')->on('r_pesan_chat');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pesan_chat');
    }
};
