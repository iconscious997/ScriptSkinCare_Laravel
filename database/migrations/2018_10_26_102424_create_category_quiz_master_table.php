<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryQuizMasterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_category', function (Blueprint $table) {
            $table->increments('id');
            // $table->integer('parent_cat_id')->unsigned();
            $table->string('category_name');
            $table->string('order');
            $table->string('step_no');
            $table->tinyInteger('status')->default('0')->comment('Active - 0, Deactive - 1');
            $table->tinyInteger('is_deleted')->default('0')->comment('0 - Not Deleted, 1 - Deleted');
            $table->dateTime('created_date');
            $table->dateTime('modified_date')
            ->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->integer('created_by');
            $table->integer('modified_by');
            // $table->timestamps();
        });

        Schema::create('product_sub_category', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id')->unsigned();
            $table->string('sub_category_name');
            $table->string('column_no')->comment('select 1 per column');
            $table->tinyInteger('status')->default('0')->comment('Active - 0, Deactive - 1');
            $table->tinyInteger('is_deleted')->default('0')->comment('0 - Not Deleted, 1 - Deleted');
            $table->dateTime('created_date');
            $table->dateTime('modified_date')
            ->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->integer('created_by');
            $table->integer('modified_by');
            // $table->timestamps();
        });

        // Insert some stuff
        DB::table('product_category')->insert(
            array(
                'email' => 'name@domain.com',
                'verified' => true
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_category');
        Schema::dropIfExists('product_sub_category');
        Schema::dropIfExists('product_quiz');
        Schema::dropIfExists('product_quiz_answer');
    }
}
