<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChatRoomMessages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::defaultStringLength(191);
        Schema::create('chat_room_messages', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedInteger('chat_room_id');
            $table->integer('users_from');
            $table->integer('users_to');
            $table->text('message')->nullable();
            $table->string('type_message')->default('text');
            $table->string('type_file')->default('');
            $table->string('status')->default('send');
            $table->integer('created_at');
            $table->integer('updated_at');
            $table->foreign('chat_room_id')->references('id')->on('chat_room')->onDelete('cascade')->onTruncate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chat_room_messages');
    }
}
