<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolePrivilegeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {  
        Schema::create('role_privilege', function (Blueprint $table) {
            $table->engine = 'InnoDB';
         //$table->integer('role_id')->unsignedBigInteger();
         //$table->foreign('role_id')->references('id')->on('roles');
         //$table->integer('privileges_id')->unsignedBigInteger();
         //$table->foreign('privileges_id')->references('id')->on('privileges');
       
          $table->integer('role_id')->unsigned();
          
            $table->integer('privileges_id')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('role_privilege');
    }
}
