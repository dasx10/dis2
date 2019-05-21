<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PriceComponents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::defaultStringLength(191);
        Schema::create('price_components', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('type');
            $table->string('value');
            $table->string('title')->default('');
            $table->integer('created_at');
            $table->integer('updated_at');
        });

        \Illuminate\Support\Facades\DB::table('price_components')->insert([
           [
               'type' => 'pallet_price',
               'value' => 10,
               'created_at' => time(),
               'updated_at' => time()
           ],
            [
                'type' => 'insurance',
                'value' => 0.1,
                'created_at' => time(),
                'updated_at' => time()
            ],
            [
                'type' => 'south_east_asia',
                'value' => 0,
                'created_at' => time(),
                'updated_at' => time()
            ],
            [
                'type' => 'north_america',
                'value' => 0,
                'created_at' => time(),
                'updated_at' => time()
            ],
            [
                'type' => 'south_america',
                'value' => 0,
                'created_at' => time(),
                'updated_at' => time()
            ],
            [
                'type' => 'mena',
                'value' => 0,
                'created_at' => time(),
                'updated_at' => time()
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('price_components');
    }
}
