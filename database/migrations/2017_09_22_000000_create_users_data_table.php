<?php

    use Illuminate\Support\Facades\Schema;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Database\Migrations\Migration;

    class CreateUsersDataTable extends Migration
    {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            Schema::defaultStringLength(191);
            Schema::create('users_data', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->increments('id');
                $table->unsignedInteger('users_id');
                $table->string('email');
                $table->string('country');
                $table->string('regione')->default('');
                $table->string('contact_name')->default('');
                $table->string('contact_name2')->default('');
                $table->string('position')->default('');
                $table->string('phone_number')->default('');
                $table->string('password')->default('');
                $table->string('company_website')->default('');
                $table->string('company_name')->default('');
                $table->string('product_of_interest')->default('');
                $table->string('industry')->default('');
                $table->string('skype')->default('');
                $table->string('office_phone')->default('');
                $table->string('email2')->default('');
                $table->string('language')->default('English');
                $table->string('nif')->default('');
                $table->string('iban')->default('');
                $table->string('billing_address')->default('');
                $table->string('banks_details')->default('');
                $table->string('dis_points')->default('0');
                $table->text('terms')->nullable();
                $table->string('dop_bank1')->default('');
                $table->string('dop_bank2')->default('');
                $table->string('bisiness_scope')->default('Industrial');
                $table->integer('can_see')->default(1);
                $table->string('potential_products')->default('');
                $table->string('preferred_destination_port')->default('');
                $table->string('preferred_packaging_style')->default('');
                $table->string('ref_id')->default('');
                $table->unsignedInteger('registered_by')->nullable();
                $table->string('payment_type_default')->default('');
                $table->string('payment_type_other')->default('');
                $table->text('limitations')->nullable();
                $table->text('notes')->nullable();
                $table->integer('created_at');
                $table->integer('updated_at');
                $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade')->onTruncate('cascade');
                $table->foreign('registered_by')->references('id')->on('users');
            });
        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down()
        {
            Schema::dropIfExists('users_data');
        }
    }
