<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreaetCategorysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categorys', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pid')->length(10)->default(0)->comment('父分类id');
            $table->string('name')->length(30)->default('')->comment('分类名称');
            $table->string('flag')->length(30)->default('')->comment('分类标识');
            $table->string('desc')->length(100)->default('')->comment('分类描述');
            $table->tinyInteger('status')->length(1)->default(1)->comment('状态:1可用 0不可用');
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
        Schema::dropIfExists('categorys');
    }
}
