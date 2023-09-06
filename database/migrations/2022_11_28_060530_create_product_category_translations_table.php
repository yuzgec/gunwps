<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_category_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable();
            $table->longText('desc')->nullable();
            $table->longText('short')->nullable();
            $table->text('slug')->nullable();

            $table->string('seo1')->nullable();
            $table->string('seo2')->nullable();
            $table->string('seo3')->nullable();

            $table->integer('product_category_id')->unsigned();
            $table->string('locale')->index();

            $table->unique(['product_category_id', 'locale']);
            $table->foreign('product_category_id')->references('id')->on('product_category')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('product_category_translations');
    }
};
