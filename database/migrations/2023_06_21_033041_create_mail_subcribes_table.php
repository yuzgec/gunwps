<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('mail_subcribes', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->string('lang')->nullable();
            $table->boolean('isUser')->nullable();
            $table->boolean('country')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('mail_subcribes');
    }
};
