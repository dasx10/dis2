<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FileAClaimFiles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::defaultStringLength(191);
        Schema::create('file_a_claim_files', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedInteger('file_a_claim_id');
            $table->string('filename')->default('');
            $table->string('type')->default('');
            $table->integer('created_at');
            $table->integer('updated_at');
            $table->foreign('file_a_claim_id')->references('id')->on('file_a_claim')->onDelete('cascade')->onTruncate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('file_a_claim_files');
    }
}
