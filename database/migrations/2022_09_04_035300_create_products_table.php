<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('product_code');
            $table->string('product_name'); 
            $table->string('product_slug'); 

            $table->integer('unit_id'); 
            $table->integer('category_id'); 
            $table->integer('brand_id'); 

            $table->double('product_cost'); 
            $table->double('product_price'); 

            $table->integer('tax_id'); 
            $table->boolean('tax_inclusive'); 

            $table->double('daily_sale_target'); 
            $table->double('alert_quantity'); 

            $table->string('product_img_url');
            $table->text('product_description'); 

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
    }
};
