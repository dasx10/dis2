<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PrizeBuy extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::defaultStringLength(191);
        Schema::create('prize_buy', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedInteger('prize_id');
            $table->unsignedInteger('users_id');
            $table->integer('created_at');
            $table->integer('updated_at');
            $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade')->onTruncate('cascade');
            $table->foreign('prize_id')->references('id')->on('prize')->onDelete('cascade')->onTruncate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prize_buy');
    }
}
