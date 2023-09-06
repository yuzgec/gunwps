<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('faq_translations', function (Blueprint $table) {
            $table->increments('id');

            $table->string('title')->nullable();
            $table->longText('desc')->nullable();

            $table->integer('faq_id')->unsigned();
            $table->string('locale')->index();

            $table->unique(['faq_id', 'locale']);
            $table->foreign('faq_id')->references('id')->on('faq')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('faq_translations');
    }
};
