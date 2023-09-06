<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('wishlist', function (Blueprint $table) {
            $table->id();

            $table->string('locale', 2)->nullable();
            $table->integer('day')->nullable();

            $table->string('name')->nullable();
            $table->string('company')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('message')->nullable();
            $table->string('address')->nullable();

            $table->string('delivery')->nullable();

            $table->string('pdf')->nullable();

            $table->double('subtotal')->nullable();
            $table->double('vat')->nullable();
            $table->double('totalprice')->nullable();

            $table->timestamps();
            $table->softDeletes();

        });
    }

    public function down()
    {
        Schema::dropIfExists('wishlist');
    }
};
