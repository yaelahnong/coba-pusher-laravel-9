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
        Schema::create('partisipan_pesan_chat', function (Blueprint $table) {
            $table->increments('ppc_id');
            $table->string('ppc_room_id', 32);
            $table->char('ppc_user_initial', 2);
            $table->unsignedTinyInteger('ppc_user_id');
            $table->timestamps();
            $table->foreign('ppc_room_id')->references('rpc_room_id')->on('r_pesan_chat');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('partisipan_pesan_chat');
    }
};
