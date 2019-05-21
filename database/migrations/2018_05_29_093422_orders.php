<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Orders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::defaultStringLength(191);
        Schema::create('orders', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedInteger('users_id');
            $table->string('po_num')->default('');
            $table->string('dis_ref')->default('');
            $table->string('payment_terms')->default('');
            $table->text('other_instructions')->nullable();
            $table->string('fob_subtotal')->default('');
            $table->string('freight_charges')->default('');
            $table->string('insurance')->default('');
            $table->string('hst')->default('');
            $table->string('total_amount')->default('');
            $table->text('pod')->nullable();
            $table->text('pol')->nullable();
            $table->string('etd')->default('');
            $table->text('eta')->default('');
            $table->string('arrival_date')->default('');
            $table->string('points')->default('0');
            $table->string('container_size')->default('');
            $table->string('bl_number')->default('');
            $table->string('shipping_company')->default('');
            $table->string('tracking_order_number')->default('');
            $table->string('tracking_link')->default('');
            $table->string('region')->default('');
            $table->string('pay_with_points')->default('0');
            $table->string('status')->default('Pending Confirmation');
            $table->integer('created_at');
            $table->integer('updated_at');
            $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade')->onTruncate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
