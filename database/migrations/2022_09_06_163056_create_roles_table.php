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
        Schema::create('roles', function (Blueprint $table) {
            $table->bigInteger('role_id')->primary();
            $table->string('role_name')->unique();
        });

        $roles = [
            ['role_id'=> 1,'role_name' => 'admin'],
            ['role_id'=> 2,'role_name' => 'stockmanager'],
            ['role_id'=> 3,'role_name' => 'salesman'],
        ];

        foreach($roles as $role){

            DB::table('roles')->insert($role);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
    }
};
