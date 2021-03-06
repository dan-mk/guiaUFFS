<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permissions', function (Blueprint $table) {
			$table->increments('id');

			$table->integer('user_id')->unsigned();
			$table->integer('section_id')->unsigned();

    		$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
			$table->foreign('section_id')->references('id')->on('sections')->onDelete('cascade');

			$table->index(['user_id', 'section_id']);
        });
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
}
