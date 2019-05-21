<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Basket extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::defaultStringLength(191);
        Schema::create('basket', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedInteger('users_id');
            $table->unsignedInteger('products_id')->nullable();
            $table->string('quantity')->default('');
            $table->string('quantity_val')->default('');
            $table->string('pallet_type')->default('');
            $table->string('packaging_type')->default('');
            $table->string('quantity_decr_key')->default('');
            $table->string('amount')->default('');
            $table->string('unit_price')->default('');
            $table->string('packaging_type_name')->default('');
            $table->integer('created_at');
            $table->integer('updated_at');
            $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade')->onTruncate('cascade');
            $table->foreign('products_id')->references('id')->on('products')->onDelete('cascade')->onTruncate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('basket');
    }
}
