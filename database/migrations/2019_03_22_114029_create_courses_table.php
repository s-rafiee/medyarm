<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->text('description');
            $table->string('image');
            $table->string('name_en');
            $table->string('name');
            $table->longText('body');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('skill_id');
            $table->foreign('skill_id')->references('id')->on('skills');
            $table->integer('active')->unsigned()->default(0);
            $table->integer('type')->unsigned()->default(0);
            $table->integer('publish')->unsigned()->default(0);
            $table->integer('level')->unsigned()->default(0);
            $table->integer('price')->unsigned()->default(0);
            $table->integer('off')->unsigned()->default(0);
            $table->integer('howsell')->unsigned()->default(0); # 0 is can not sell a lessons
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
        Schema::dropIfExists('courses');
    }
}
