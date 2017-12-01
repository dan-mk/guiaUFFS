<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParentagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parentages', function (Blueprint $table) {
			$table->integer('parent')->unsigned();
			$table->integer('child')->unsigned()->unique();
			$table->foreign('parent')->references('id')->on('sections')->onDelete('cascade');
			$table->foreign('child')->references('id')->on('sections')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('parentages');
    }
}
