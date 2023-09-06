<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('contact', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100)->nullable();
            $table->string('email', 100)->nullable();
            $table->string('phone', 100)->nullable();
            $table->string('subject', 100)->nullable();
            $table->string('service', 100)->nullable();
            $table->string('lang', 2)->nullable();
            $table->longText('message')->nullable();
            $table->integer('status')->default(0);
            $table->timestamps();
            $table->softDeletes();

        });
    }

    public function down()
    {
        Schema::dropIfExists('contact');
    }
};
