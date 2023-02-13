<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAllTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->timestamps();
        });

        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id')->unsigned()->nullable();
            $table->string('category_name');
            $table->timestamps();

            $table->foreign('parent_id')->references('id')->on('categories');
        });

        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug')->unique();
            $table->string('product_name');
            $table->integer('category_id')->unsigned();
            $table->integer('product_price');
            $table->text('product_description');
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('categories');
        Schema::dropIfExists('products');
    }
}
