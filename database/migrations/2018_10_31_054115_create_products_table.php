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
           $table->text('barcode_image');
           $table->text('product_image')->comment('Primary Image');
           $table->text('product_application_instructions');

           $table->string('basic_skincare');
           $table->string('active_skincare');
           $table->string('column_1');
           $table->string('column_2');
           $table->string('column_3');
           $table->string('column_4');

           $table->string('gender');
           $table->string('pregnant');
           $table->string('age_group');
           $table->string('disclaimer_pregnant');

           $table->string('body_areas');
           $table->string('timeofday');

           $table->string('sensitive');
           $table->string('disclaimer_sensitive'); 

           $table->string('active_suitable');
           $table->text('active_ingredient'); 

           $table->string('skin_type_oily');
           $table->string('skin_type_dry'); 
           $table->string('skin_type_combination');
           $table->string('skin_type_normal'); 
           $table->text('marketing_message');

           $table->string('consumers_concern'); 
           $table->text('irration_concern'); 
           $table->text('ethical_consideration'); 

           $table->string('wholesale_cost'); 
           $table->string('rrp_cost'); 
           $table->string('product_visible_id'); 

           $table->string('approval')->comment('0 - activated, 1- not activated, 2-cancelled'); 
          
           $table->tinyInteger('status')->comment('Active - 0, Deactive - 1');
           $table->tinyInteger('is_deleted')->default('0')->comment('0 - Not Deleted, 1 - Deleted');
           $table->dateTime('created_date');
           $table->dateTime('modified_date')
           ->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
           $table->integer('created_by');
           $table->integer('modified_by');
       });


        Schema::create('product_visibility', function(Blueprint $table) {
            $table->increments('id');
            $table->string('product_visible_places');            
            $table->tinyInteger('status')->comment('Active - 0, Deactive - 1');
            $table->tinyInteger('is_deleted')->default('0')->comment('0 - Not Deleted, 1 - Deleted');
            $table->dateTime('created_date');
            $table->dateTime('modified_date')
                    ->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->integer('created_by');
            $table->integer('modified_by');
            
        });


        Schema::create('product_images', function(Blueprint $table) {
            $table->increments('id');
            $table->string('image');     
            $table->tinyInteger('is_primary')->comment('Primary - 1, Not Primary - 0');
            $table->integer('product_id');
            $table->tinyInteger('status')->comment('Active - 0, Deactive - 1');
            $table->tinyInteger('is_deleted')->default('0')->comment('0 - Not Deleted, 1 - Deleted');
            $table->dateTime('created_date');
            $table->dateTime('modified_date')
                    ->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->integer('created_by');
            $table->integer('modified_by');
            
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
       Schema::dropIfExists('product_visibility');
       Schema::dropIfExists('product_images');
       
   }
}