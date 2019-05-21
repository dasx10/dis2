<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DolchemProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::defaultStringLength(191);
        Schema::create('doclhem_products', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedInteger('dolchem_products_categories_id');
            $table->unsignedInteger('products_id');
            $table->integer('created_at');
            $table->integer('updated_at');
            $table->foreign('dolchem_products_categories_id')->references('id')->on('dolchem_products_categories')->onDelete('cascade')->onTruncate('cascade');
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
        Schema::dropIfExists('doclhem_products');
    }
}
