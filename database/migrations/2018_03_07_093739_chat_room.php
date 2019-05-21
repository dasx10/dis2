<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChatRoom extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::defaultStringLength(191);
        Schema::create('chat_room', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedInteger('users_id_f');
            $table->unsignedInteger('users_id_s');
            $table->string('type_of_users_id_f')->default('');
            $table->string('type_of_users_id_s')->default('');
            $table->integer('hide_for_users_id_f')->default('0');
            $table->integer('hide_for_users_id_s')->default('0');
            $table->integer('created_at');
            $table->integer('updated_at');
            $table->foreign('users_id_f')->references('id')->on('users')->onDelete('cascade')->onTruncate('cascade');
            $table->foreign('users_id_s')->references('id')->on('users')->onDelete('cascade')->onTruncate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chat_room');
    }
}
