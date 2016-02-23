<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePicturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pictures', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });
        Schema::create('article_picture', function (Blueprint $table) {
            $table->integer('article_id')->unsigned()->index();/*unsigned pozitivan broj*/
            $table->foreign('article_id')->references('id')->on('articles')->onDelete('cascade');
            $table->integer('picture_id')->unsigned()->index();
            $table->foreign('picture_id')->references('id')->on('pictures')->onDelete('cascade');

            $table->integer('main');
            $table->timestamps();

        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('pictures');
        Schema::drop('article_picture');
    }
}
