<?php

    use Illuminate\Support\Facades\Schema;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Database\Migrations\Migration;

    class CreateAdminDocumentsFileTable extends Migration
    {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            Schema::defaultStringLength(191);
            Schema::create('admins_documents_file', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->increments('id');
                $table->unsignedInteger('admins_documents_id');
                $table->integer('edit_admins_id');
                $table->string('url');
                $table->integer('created_at');
                $table->integer('updated_at');
                $table->foreign('admins_documents_id')->references('id')->on('admins_documents')->onDelete('cascade')->onTruncate('cascade');
            });
        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down()
        {
            Schema::dropIfExists('admins_documents_file');
        }
    }
