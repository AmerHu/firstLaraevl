<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->double('price');
            $table->string('img');
            $table->boolean('active')->default(true);
            $table->integer('cate_id')->unsigned();
            $table->integer('desc_id')->unsigned();
            $table->timestamps();
        });
        Schema::table('items', function ($table) {
            $table->foreign('cate_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('desc_id')->references('id')->on('descriptions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items');
    }
}
