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
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('brand_id')->unsigned();
            $table->integer('product_line_id')->unsigned();
            $table->string('product_name');
            $table->string('product_code')->comment('SKU')->unique();
            $table->string('product_size');
            $table->text('product_image');
            $table->text('product_text');

            // product_measurement_id              F
            // barcode_img
            // product_application_instructions
            // category_id
            // subcategory_id
            // quize_id            (1, 3, 4)
            // answer_id
            // cost_wholesale
            // cost_RRP
            // read_pricing_disclaimer             (0 - not checked, 1 - checked)
            // marketing_message
            // product_visible_id                  (multiple)  
            // is_activated                        (0 - activated, 1- not activated, 2-cancelled)
            $table->tinyInteger('status')->comment('Active - 0, Deactive - 1');
            $table->tinyInteger('is_deleted')->default('0')->comment('0 - Not Deleted, 1 - Deleted');
            $table->dateTime('created_date');
            $table->dateTime('modified_date')
            ->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->integer('created_by');
            $table->integer('modified_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product');
    }
}
