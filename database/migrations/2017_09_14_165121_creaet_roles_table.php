<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreaetRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->length(30)->default('')->comment('角色名称');
            $table->string('desc')->length(30)->default('')->comment('角色描述');
            $table->tinyInteger('status')->length(1)->default(1)->comment('角色状态:1可用0不可用');
            $table->text('rules')->comment('角色规则,保存的是权限的id,多个逗号分割');
            $table->timestamps();
        });
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
}
