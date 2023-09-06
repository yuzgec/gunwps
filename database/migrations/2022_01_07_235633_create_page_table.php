<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePageTable extends Migration
{

    public function up()
    {
        Schema::create('page', function (Blueprint $table) {
            $table->increments('id');
            $table->string('category')->nullable();
            $table->integer('status')->default(1);
            $table->integer('rank')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

}
