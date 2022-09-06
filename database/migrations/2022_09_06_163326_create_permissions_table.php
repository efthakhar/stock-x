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
        Schema::create('permissions', function (Blueprint $table) {
            $table->bigInteger('permission_id')->primary();
            $table->string('permission_name')->unique();
        });

        $permissions = [
            ['permission_id'=> 1,'permission_name' => 'view_product'],
            ['permission_id'=> 2,'permission_name' => 'create_product'],
            ['permission_id'=> 3,'permission_name' => 'update_product'],
            ['permission_id'=> 4,'permission_name' => 'delete_product'],
        ];

        foreach($permissions as $permission){

            DB::table('permissions')->insert($permission);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permissions');
    }
};
