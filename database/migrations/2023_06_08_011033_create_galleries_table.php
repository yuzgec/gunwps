<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('gallery', function (Blueprint $table) {
            $table->increments('id');
            $table->string('category')->nullable();
            $table->integer('status')->default(1);
            $table->integer('rank')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('gallery');
    }
};
