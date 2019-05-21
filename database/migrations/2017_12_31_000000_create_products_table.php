<?php

    use Illuminate\Support\Facades\Schema;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Database\Migrations\Migration;

    class CreateProductsTable extends Migration
    {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            Schema::defaultStringLength(191);
            Schema::create('products', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->increments('id');
                $table->unsignedInteger('created_by');
                $table->string('product_name')->default('');
                $table->string('product_code')->default('');
                $table->string('specification')->default('');
                $table->string('category')->default('');
                $table->string('brand')->default('');
                $table->string('shipping_class')->default('');

                $table->string('type_of_packaging1')->default('');
                $table->string('type_of_packaging2')->default('');
                $table->string('type_of_packaging3')->default('');

                $table->string('type_of_packaging1_price')->default('');
                $table->string('type_of_packaging2_price')->default('');
                $table->string('type_of_packaging3_price')->default('');

                $table->string('pallet_capacity_for_packaging_type_1')->default('');
                $table->string('pallet_capacity_for_packaging_type_2')->default('');
                $table->string('pallet_capacity_for_packaging_type_3')->default('');


                //Moc 1
                $table->string('moc_1_1')->default('');
                $table->string('moc_1_2')->default('');
                $table->string('moc_1_3')->default('');

                //Moc 2
                $table->string('moc_2_1')->default('');
                $table->string('moc_2_2')->default('');
                $table->string('moc_2_3')->default('');

                //Moc 3
                $table->string('moc_3_1')->default('');
                $table->string('moc_3_2')->default('');
                $table->string('moc_3_3')->default('');

                $table->string('pallet_without_pallet')->default('');
                $table->string('cas')->default('');

                $table->bigInteger('quantity')->default(0);

                $table->string('price')->default('');

                $table->string('lwh_packaging1_wp')->default('');
                $table->string('lwh_packaging1_p')->default('');

                $table->string('lwh_packaging2_wp')->default('');
                $table->string('lwh_packaging2_p')->default('');

                $table->string('lwh_packaging3_wp')->default('');
                $table->string('lwh_packaging3_p')->default('');

                $table->string('loading_port')->default('');
                $table->string('restrictions')->default('');
                $table->text('descr')->nullable();
                $table->string('fcl')->default('');




                $table->integer('active')->default('1')->comment='1-on,0-off';
                $table->integer('absent')->default('0')->comment='1-on,0-off';;
                $table->integer('is_deleted')->default('0');
                $table->bigInteger('in_stock')->default(0);
                $table->integer('created_at');
                $table->integer('updated_at');
                $table->foreign('created_by')->references('id')->on('admins')->onDelete('cascade')->onTruncate('cascade');
            });
        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down()
        {
            Schema::dropIfExists('products');
        }
    }
