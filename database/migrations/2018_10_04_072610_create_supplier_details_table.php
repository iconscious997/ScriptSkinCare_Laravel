<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSupplierDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('supplier_details', function (Blueprint $table) {
        $table->increments('id');
        $table->integer('user_id')->unsigned();
        $table->integer('company_id')->unsigned();
        $table->integer('user_parent_id')->default(0)->comment('0  - supplier admin, else respective parent user_id');
        $table->string('first_name');
        $table->string('last_name');
        $table->string('supplier_name');
        $table->string('business_tel_number',30);
        $table->text('business_address_line_1');
        $table->text('business_address_line_2')->nullable();
        $table->string('city',200)->nullable();
        $table->string('state',200)->nullable();
        $table->string('country')->nullable();
        $table->string('mobile_number',20);
        $table->string('brand_ids')->comment('comma seperator - e.g 1,5,3')->nullable();
        $table->tinyInteger('status')->comment('Active - 0, Deactive - 1');
        $table->tinyInteger('is_deleted')->default('0')->comment('0 - Not Deleted, 1 - Deleted');
        $table->dateTime('created_date');
        $table->dateTime('modified_date')
        ->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        $table->integer('created_by');
        $table->integer('modified_by');
        // $table->timestamps();

        // give relations between tables
        $table->foreign('user_id')
        ->references('id')
        ->on('users')
        ->onDelete('cascade');
            /* $table->foreign('company_id')
            ->references('id')
            ->on('company_details')
            ->onDelete('cascade'); */
          });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::dropIfExists('supplier_details');
    }
  }
