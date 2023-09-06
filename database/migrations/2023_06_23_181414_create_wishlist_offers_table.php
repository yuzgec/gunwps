<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('wishlist_offer', function (Blueprint $table) {
            $table->id();

            $table->integer('user_id')->nullable();

            $table->longText('offermessage')->nullable();
            $table->longText('extraproduct')->nullable();

            $table->double('subtotal')->nullable();
            $table->double('vat')->nullable();
            $table->double('totalprice')->nullable();

            $table->double('deliveryprice')->nullable();

            $table->string('discount_type')->nullable();
            $table->integer('discount_rate')->nullable();

            $table->integer('discount_amount')->nullable();


            $table->boolean('sendmail')->default(false);
            $table->boolean('sendsms')->default(false);

            $table->foreignId('wishlist_id')->references('id')->on('wishlist')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('wishlist_offer');
    }

};
