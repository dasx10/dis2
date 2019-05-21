<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class OrdersProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::defaultStringLength(191);
        Schema::create('orders_products', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedInteger('orders_id');
            $table->integer('products_id')->nullable();
            $table->string('products_name')->default('');
            $table->string('products_specification')->default('');
            $table->string('products_packaging_type')->default('');
            $table->string('products_pallet_wpallet')->default('');
            $table->string('products_unit_price')->default('');
            $table->string('quantity')->default('');
            $table->string('quantity_val')->default('');
            $table->integer('created_at');
            $table->integer('updated_at');
            $table->foreign('orders_id')->references('id')->on('orders')->onDelete('cascade')->onTruncate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders_products');
    }
}
