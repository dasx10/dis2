<?php

    use Illuminate\Support\Facades\Schema;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Database\Migrations\Migration;

    class CreateAdminsTable extends Migration
    {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            Schema::defaultStringLength(191);
            Schema::create('admins', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->increments('id');
                $table->unsignedInteger('users_id');
                $table->string('name')->default('');
                $table->string('email')->default('');
                $table->string('password')->default('');
                $table->string('role')->default('');
                $table->string('regione')->default('');
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
            Schema::dropIfExists('admins');
        }
    }
