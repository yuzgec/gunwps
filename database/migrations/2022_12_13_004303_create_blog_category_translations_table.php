<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('blog_category_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable();
            $table->longText('desc')->nullable();
            $table->longText('short')->nullable();
            $table->text('slug')->nullable();

            $table->string('seo1')->nullable();
            $table->string('seo2')->nullable();
            $table->string('seo3')->nullable();

            $table->integer('blog_category_id')->unsigned();
            $table->string('locale')->index();

            $table->unique(['blog_category_id', 'locale']);
            $table->foreign('blog_category_id')->references('id')->on('blog_category')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('blog_category_translations');
    }
};
