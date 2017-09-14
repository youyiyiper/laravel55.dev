<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreaetSidebarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sidebars', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->length(30)->default('')->comment('菜单名称');
            $table->string('class')->length(30)->default('')->comment('菜单icon');
            $table->string('purview_flag')->length(50)->default('')->comment('菜单权限');
            $table->tinyInteger('is_active')->length(1)->default(0)->comment('是否激活高亮');
            $table->integer('pid')->length(10)->default(0)->comment('父类id');
            $table->string('url')->length(50)->default('')->comment('菜单地址');
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
        Schema::dropIfExists('sidebars');
    }
}
