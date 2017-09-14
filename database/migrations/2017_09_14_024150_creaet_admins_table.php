<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreaetAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->length(30)->comment('用户名称');
            $table->tinyInteger('status')->length(1)->default(1)->comment('角色状态:1可用 0不可用');
            $table->string('headimg')->length(80)->default('')->comment('用户头像');
            $table->string('email')->length(30)->unique()->comment('用户邮箱');
            $table->string('password')->length('255')->comment('用户密码');
            $table->rememberToken();
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
        Schema::dropIfExists('admins');
    }
}
