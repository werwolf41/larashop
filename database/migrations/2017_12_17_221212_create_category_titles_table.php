<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryTitlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_titles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id')->index()->unsigned()->default(0);
            $table->integer('language_id')->index()->unsigned()->default(0);
            $table->string('name');
            $table->text('description');
            $table->string('meta_title', 100);
            $table->string('meta_description', 255);
            $table->text('meta_keywords');

            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('language_id')->references('id')->on('languages');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropForeign('category_titles_category_id_foreign');
        Schema::dropForeign('category_titles_language_code_foreign');
        Schema::dropIfExists('category_titles');
    }
}
