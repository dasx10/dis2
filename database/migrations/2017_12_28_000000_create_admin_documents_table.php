<?php

    use Illuminate\Support\Facades\Schema;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Database\Migrations\Migration;

    class CreateAdminDocumentsTable extends Migration
    {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            Schema::defaultStringLength(191);
            Schema::create('admins_documents', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->increments('id');
                $table->string('title');
                $table->string('category');
                $table->unsignedInteger('admins_id');
                $table->integer('created_at');
                $table->integer('updated_at');
                $table->foreign('admins_id')->references('id')->on('admins')->onDelete('cascade')->onTruncate('cascade');
            });
        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down()
        {
            Schema::dropIfExists('admins_documents');
        }
    }
