<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Notifications extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::defaultStringLength(191);
        Schema::create('notifications', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedInteger('admins_id')->nullable();
            $table->text('message')->nullable();
            $table->string('title')->default('');
            $table->integer('is_new')->default('1');
            $table->integer('is_view')->default('1');
            $table->string('src')->default('');
            $table->integer('created_at');
            $table->integer('updated_at');
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
        Schema::dropIfExists('notifications');
    }
}
