<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddProductcategoryEventcategoryUserBrandColumnsToProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            //
            $table->integer('product_category_id')->unsigned();
            $table->integer('brand_id')->unsigned();
            $table->integer('user_id')->unsigned();
          
            //$table->foreign('category_id')
           // ->references('id')
            //->on('product_categories');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            //
            $table->dropColumn('product_category_id');
            $table->dropColumn('brand_id')->unsigned();
            $table->dropColumn('user_id')->unsigned();
          
        });
    }
}
