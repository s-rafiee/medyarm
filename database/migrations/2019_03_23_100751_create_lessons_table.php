<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLessonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lessons', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('cours_id');
            $table->unsignedBigInteger('user_id');
            $table->string('title');
            $table->string('title_en');
            $table->string('description');
            $table->longText('body');
            $table->string('image');
            $table->integer('active')->unsigned()->default(0);
            $table->integer('visit')->unsigned()->default(0);
            $table->integer('price')->unsigned()->default(0);
            $table->string('time')->default('');
            $table->string('link')->default('');
            $table->foreign('cours_id')->references('id')->on('courses');
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('lessons');
    }
}
