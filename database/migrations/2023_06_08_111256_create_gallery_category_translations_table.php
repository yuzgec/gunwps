<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('gallery_category_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable();
            $table->longText('desc')->nullable();
            $table->longText('short')->nullable();
            $table->text('slug')->nullable();

            $table->string('seo1')->nullable();
            $table->string('seo2')->nullable();
            $table->string('seo3')->nullable();

            $table->integer('gallery_category_id')->unsigned();
            $table->string('locale')->index();

            $table->unique(['gallery_category_id', 'locale']);
            $table->foreign('gallery_category_id')->references('id')->on('gallery_category')->onDelete('cascade');
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('gallery_category_translations');
    }
};
