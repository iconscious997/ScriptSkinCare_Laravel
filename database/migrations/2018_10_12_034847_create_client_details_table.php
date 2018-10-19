<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_details', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name',50);
            $table->string('last_name',50);
            $table->dateTime('dob');
            $table->string('address_line1')->nullable();
            $table->string('address_line2')->nullable();
            $table->string('city',50)->nullable();
            $table->string('state',50)->nullable();
            $table->string('country',50)->nullable();
            $table->string('phone_number',50)->nullable();
            $table->string('mobile_number',50)->nullable();
            $table->string('email',255);
            $table->string('gender');
            $table->string('pregnancy_status')->nullable();
            $table->string('loyalty_points')->nullable();
            $table->string('email_subscription')->nullable();
            $table->string('skin_type')->nullable();
            $table->string('skin_concerns')->nullable();
            $table->string('routine')->nullable();
            $table->string('sensitivity_level')->nullable();
            $table->string('history')->nullable();
            $table->tinyInteger('status')->comment('Active - 0, Deactive - 1');
            $table->string('signup_source')->nullable();
            $table->tinyInteger('is_deleted')->default('0')->comment('0 - Not Deleted, 1 - Deleted');
            $table->dateTime('created_date');
            $table->dateTime('modified_date')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->integer('created_by');
            $table->integer('modified_by');
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('client_details');
    }
}
