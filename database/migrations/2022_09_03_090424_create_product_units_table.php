<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        Schema::create('product_units', function (Blueprint $table) {
            $table->id();
            $table->string('unit_name');
            $table->string('unit_code');
            $table->boolean('locked')->nullable();
        });

        $default_units = [
            [ 'unit_name' =>'meter','unit_code' => 'm','locked' => true ],
            [ 'unit_name' =>'kilogram','unit_code' => 'kg','locked' => true ],
            [ 'unit_name' =>'peace','unit_code' => 'pc','locked' => true ],
            [ 'unit_name' =>'liter','unit_code' => 'l','locked' => true ],   
               
        ];

        foreach($default_units as $unit){
            
            DB::table('product_units')->insert([
                'unit_name' => $unit['unit_name'],
                'unit_code' => $unit['unit_code'],
                'locked' => $unit['locked']
            ]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_units');
    }
};
