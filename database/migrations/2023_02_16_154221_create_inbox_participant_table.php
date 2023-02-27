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
        Schema::create('inbox_participant', function (Blueprint $table) {
            $table->increments('ip_id');
            $table->unsignedTinyInteger('ip_user_id');
            $table->string('ip_in_id', 32);
            $table->timestamps();
            $table->foreign('ip_in_id')->references('in_id')->on('inbox');
            $table->foreign('ip_user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inbox_participant');
    }
};
