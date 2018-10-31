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
        
        $category_data = [
            [
                'category_name' => 'Cleanser / makeup remover',
                'order'         => 1,
                'step_no'       => 2,
                'created_date'  => date('Y-m-d H:i:s'),
                'created_by'    => 1,
                'modified_by'   => 1,
            ],
            [
                'category_name' => 'Moisteriser',
                'order'         => 2,
                'step_no'       => 2,
                'created_date'  => date('Y-m-d H:i:s'),
                'created_by'    => 1,
                'modified_by'   => 1,
            ],
            [
                'category_name' => 'Toner',
                'order'         => 3,
                'step_no'       => 2,
                'created_date'  => date('Y-m-d H:i:s'),
                'created_by'    => 1,
                'modified_by'   => 1,
            ],
            [
                'category_name' => 'Sunscreen',
                'order'         => 4,
                'step_no'       => 2,
                'created_date'  => date('Y-m-d H:i:s'),
                'created_by'    => 1,
                'modified_by'   => 1,
            ],
            [
                'category_name' => 'Scrub',
                'order'         => 1,
                'step_no'       => 21,
                'created_date'  => date('Y-m-d H:i:s'),
                'created_by'    => 1,
                'modified_by'   => 1,
            ],
            [
                'category_name' => 'Actives',
                'order'         => 2,
                'step_no'       => 21,
                'created_date'  => date('Y-m-d H:i:s'),
                'created_by'    => 1,
                'modified_by'   => 1,
            ],
            [
                'category_name' => 'Treatments',
                'order'         => 3,
                'step_no'       => 21,
                'created_date'  => date('Y-m-d H:i:s'),
                'created_by'    => 1,
                'modified_by'   => 1,
            ]
        ];
        
        // Insert some stuff
        DB::table('product_category')->insert($category_data);

        $sub_cat_1 = ['Beaded', 'Cleansing device', 'Cream', 'Eye makeup remover', 'Foaming', 'Gel', 'Micellar water', 'Milk', 'Wipes' ];
        $sub_cat_2 = ['Alcohol base', 'Astringent', 'Glycerin base', 'Glycolic base', 'Water base'];
        $sub_cat_3 = ['Balm', 'Cream', 'Gel', 'Lotion', 'Ointment', 'Serum'];
        $sub_cat_4_1 = ['15+', '30+', '50+'];
        $sub_cat_4_2 = ['Chemical', 'Physical', 'Chemical + physical'];
        $sub_cat_4_3 = ['Cream', 'Dry touch', 'Fluid', 'Gel', 'Lotion', 'Spray', 'Stick'];
        $sub_cat_5_1 = ['Beaded', 'Cream', 'Dry', 'Gel', 'Lotion'];
        $sub_cat_5_2 = ['Chemical', 'Manual', 'Manual + chemical'];
        $sub_cat_6 = ['Cream', 'Gel', 'Lotion', 'Oil', 'Serum', 'Water'];
        $sub_cat_7 = ['Mask', 'Peel', 'Spot'];

        $sub_category_details = [];
        foreach ($sub_cat_1 as $cat1) {
            $sub_category_details[] = [
                'category_id'           => 1,
                'sub_category_name'     => $cat1,
                'column_no'             => 1,
                'created_date'          => date('Y-m-d H:i:s'),
                'created_by'            => 1,
                'modified_by'           => 1,
            ];
        }

        foreach ($sub_cat_2 as $cat2) {
            $sub_category_details[] = [
                'category_id'           => 2,
                'sub_category_name'     => $cat2,
                'column_no'             => 1,
                'created_date'          => date('Y-m-d H:i:s'),
                'created_by'            => 1,
                'modified_by'           => 1,
            ];
        }

        foreach ($sub_cat_3 as $cat3) {
            $sub_category_details[] = [
                'category_id'           => 3,
                'sub_category_name'     => $cat3,
                'column_no'             => 1,
                'created_date'          => date('Y-m-d H:i:s'),
                'created_by'            => 1,
                'modified_by'           => 1,
            ];
        }

        foreach ($sub_cat_4_1 as $cat41) {
            $sub_category_details[] = [
                'category_id'           => 4,
                'sub_category_name'     => $cat41,
                'column_no'             => 1,
                'created_date'          => date('Y-m-d H:i:s'),
                'created_by'            => 1,
                'modified_by'           => 1,
            ];
        }

        foreach ($sub_cat_4_2 as $cat42) {
            $sub_category_details[] = [
                'category_id'           => 4,
                'sub_category_name'     => $cat42,
                'column_no'             => 2,
                'created_date'          => date('Y-m-d H:i:s'),
                'created_by'            => 1,
                'modified_by'           => 1,
            ];
        }

        foreach ($sub_cat_4_3 as $cat43) {
            $sub_category_details[] = [
                'category_id'           => 4,
                'sub_category_name'     => $cat43,
                'column_no'             => 3,
                'created_date'          => date('Y-m-d H:i:s'),
                'created_by'            => 1,
                'modified_by'           => 1,
            ];
        }

        foreach ($sub_cat_5_1 as $cat51) {
            $sub_category_details[] = [
                'category_id'           => 5,
                'sub_category_name'     => $cat51,
                'column_no'             => 1,
                'created_date'          => date('Y-m-d H:i:s'),
                'created_by'            => 1,
                'modified_by'           => 1,
            ];
        }

        foreach ($sub_cat_5_2 as $cat52) {
            $sub_category_details[] = [
                'category_id'           => 5,
                'sub_category_name'     => $cat52,
                'column_no'             => 2,
                'created_date'          => date('Y-m-d H:i:s'),
                'created_by'            => 1,
                'modified_by'           => 1,
            ];
        }

        foreach ($sub_cat_6 as $cat6) {
            $sub_category_details[] = [
                'category_id'           => 6,
                'sub_category_name'     => $cat6,
                'column_no'             => 1,
                'created_date'          => date('Y-m-d H:i:s'),
                'created_by'            => 1,
                'modified_by'           => 1,
            ];
        }

        foreach ($sub_cat_7 as $cat7) {
            $sub_category_details[] = [
                'category_id'           => 7,
                'sub_category_name'     => $cat7,
                'column_no'             => 1,
                'created_date'          => date('Y-m-d H:i:s'),
                'created_by'            => 1,
                'modified_by'           => 1,
            ];
        }

        DB::table('product_sub_category')->insert($sub_category_details);
        
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
        // Schema::dropIfExists('product_quiz');
        // Schema::dropIfExists('product_quiz_answer');
    }
}
