<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreaetArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id')->length(10)->default(0)->comment('分类id');
            $table->string('title')->length(50)->default('')->comment('文章标题');
            $table->text('content')->comment('文章内容');
            $table->string('desc')->length(120)->default('')->comment('文章描述');
            $table->timestamps();
            $table->unique('title');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
}
