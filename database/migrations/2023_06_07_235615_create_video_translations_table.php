<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('video_translations', function (Blueprint $table) {
            $table->increments('id');

            $table->string('title')->nullable();
            $table->longText('desc')->nullable();
            $table->text('slug')->nullable();

            $table->string('seo1')->nullable();
            $table->string('seo2')->nullable();
            $table->string('seo3')->nullable();

            $table->integer('video_id')->unsigned();
            $table->string('locale')->index();

            $table->unique(['video_id', 'locale']);
            $table->foreign('video_id')->references('id')->on('video')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('video_translations');
    }
};
