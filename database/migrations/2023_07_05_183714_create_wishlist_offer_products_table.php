<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('wishlist_offer_products', function (Blueprint $table) {
            $table->id();
            $table->integer('product_changed_id')->nullable();
            $table->integer('product_id')->nullable();

            $table->foreignId('wishlist_offer_id')->references('id')->on('wishlist_offer')->onDelete('cascade');
            $table->foreignId('wishlist_id')->references('id')->on('wishlist')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('wishlist_offer_products');
    }
};
