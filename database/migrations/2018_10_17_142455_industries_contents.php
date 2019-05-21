<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class IndustriesContents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::defaultStringLength(191);
        Schema::create('industries_contents', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedInteger('industries_id');
            $table->string('src')->default('');
            $table->string('src_hover')->default('');
            $table->text('title')->nullable();
            $table->text('descr')->nullable();
            $table->string('link')->default('');
            $table->string('src1')->default('');
            $table->integer('position')->nullable();
            $table->integer('created_at');
            $table->integer('updated_at');
            $table->foreign('industries_id')->references('id')->on('industries')->onDelete('cascade')->onTruncate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('industries_contents');
    }
}
