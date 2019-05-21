<?php

    use Illuminate\Support\Facades\Schema;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Database\Migrations\Migration;

    class CreateProductsDocumentTable extends Migration
    {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            Schema::defaultStringLength(191);
            Schema::create('products_document', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->increments('id');
                $table->unsignedInteger('products_id');
                $table->string('filename')->default('');
                $table->integer('created_at');
                $table->integer('updated_at');
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
            Schema::dropIfExists('products_document');
        }
    }
