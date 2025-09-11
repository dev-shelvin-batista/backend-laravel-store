<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->string('description', 128);
            $table->string('reference', 128);
            $table->integer('price');
            $table->integer('weight');
            $table->unsignedInteger('category_id');
            $table->integer('stock');
            $table->timestamps();
        });
        Schema::table('product', function($table) {
            $table->foreign('category_id')->references('id')->on('category')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product');
    }
}
