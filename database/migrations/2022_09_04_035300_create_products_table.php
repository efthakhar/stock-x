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
            $table->string('product_code')->unique();
            $table->string('product_name')->unique(); 
            $table->string('product_slug')->unique(); 

            $table->integer('unit_id'); 
            $table->integer('category_id'); 
            $table->integer('brand_id')->nullable(); 

            $table->double('product_cost'); 
            $table->double('product_price'); 

            $table->integer('tax_id')->nullable(); 
            $table->boolean('tax_inclusive')->nullable(); 

            $table->double('daily_sale_target')->nullable(); 
            $table->double('alert_quantity')->nullable(); 

            $table->string('product_img_url')->nullable();
            $table->text('product_description')->nullable(); 

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
