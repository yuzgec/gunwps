<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('faq', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category')->nullable();
            $table->integer('product_id')->nullable();
            $table->integer('service_id')->nullable();
            $table->integer('page_id')->nullable();
            $table->integer('status')->default(1);
            $table->integer('rank')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('faq');
    }
};
