<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDefaultExtrasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('default_extras', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('default_id')->unsigned();
            $table->integer('item_id')->unsigned();
            $table->timestamps();
        });
        Schema::table('default_extras', function ($table) {
            $table->foreign('default_id')->references('id')->on('extras')->onDelete('cascade');
            $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('default_extras');
    }
}
