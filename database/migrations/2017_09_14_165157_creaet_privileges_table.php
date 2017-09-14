<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreaetPrivilegesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('privileges', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pid')->length(10)->default(0)->comment('父类id');
            $table->string('name')->length(30)->default('')->comment('权限名称');
            $table->string('flag')->length(50)->default('')->comment('权限标识');
            $table->string('desc')->length(50)->default('')->comment('权限描述');
            $table->timestamps();
            $table->unique('flag');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('privileges');
    }
}
