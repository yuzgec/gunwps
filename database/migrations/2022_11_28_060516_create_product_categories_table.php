<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('product_category', function (Blueprint $table) {

            $table->increments('id');
            $table->nestedSet();

            $table->integer('status')->default(1);
            $table->integer('rank')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('product_category');
    }
};
