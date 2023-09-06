<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('wishlist_product', function (Blueprint $table) {
            $table->id();

            $table->string('product_name')->nullable();
            $table->integer('product_id')->nullable();
            $table->double('price')->nullable();
            $table->integer('quantity')->nullable();
            $table->foreignId('wishlist_id')->references('id')->on('wishlist')->onDelete('cascade');

        });
    }

    public function down()
    {
        Schema::dropIfExists('wishlist_product');
    }
};
