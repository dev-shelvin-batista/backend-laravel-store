<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaleDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_detail', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->unsignedInteger('sale_id');
            $table->unsignedInteger('product_id');
            $table->integer('price');
            $table->integer('count');
            $table->integer('total');
            $table->timestamps();
        });

        Schema::table('sale_detail', function($table) {
            $table->foreign('sale_id')->references('id')->on('sale')->onDelete('cascade');
        });

        Schema::table('sale_detail', function($table) {
            $table->foreign('product_id')->references('id')->on('product')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sale_detail');
    }
}
