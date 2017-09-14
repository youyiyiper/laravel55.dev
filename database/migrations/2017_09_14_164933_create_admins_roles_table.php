<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminsRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins_roles', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('admin_id')->length(10);
            $table->unsignedInteger('role_id')->length(10);
            $table->index('admin_id');
            $table->index('role_id');
            $table->unique(['admin_id','role_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admins_roles');
    }
}
