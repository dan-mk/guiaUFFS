<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePageVersionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('page_versions', function (Blueprint $table) {
            $table->increments('id');
			$table->string('title');
			$table->text('content');
            $table->timestamps();

			$table->integer('page_id')->unsigned();
			$table->integer('user_id')->unsigned();

			$table->foreign('page_id')->references('id')->on('pages')->onDelete('cascade');
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('page_versions');
    }
}
