<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::defaultStringLength(191);
        Schema::create('sessions', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedInteger('users_id')->default('');
            $table->unsignedInteger('admins_id')->default('');
            $table->string('token');
            $table->string('ip')->default('');
            $table->string('user_agent')->default('');
            $table->integer('created_at');
            $table->integer('updated_at');
            $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade')->onTruncate('cascade');
            $table->foreign('admins_id')->references('id')->on('admins')->onDelete('cascade')->onTruncate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sessions');
    }
}
