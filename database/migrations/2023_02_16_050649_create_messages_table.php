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
        Schema::create('messages', function (Blueprint $table) {
            $table->increments('ms_id');
            $table->string('ms_in_id', 32);
            $table->unsignedTinyInteger('ms_user_id');
            $table->string('ms_user_name', 128);
            $table->string('ms_message', 128);
            $table->string('ms_message_time', 16);
            $table->timestamps();
            $table->foreign('ms_in_id')->references('in_id')->on('inbox');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('messages');
    }
};
