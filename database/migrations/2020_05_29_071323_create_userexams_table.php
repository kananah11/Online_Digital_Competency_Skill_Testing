<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserexamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('userexams', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('userexamset_id');
            $table->integer('numexam');
            $table->integer('exam_id');
            $table->integer('ch1');
            $table->integer('ch2');
            $table->integer('ch3');
            $table->integer('ch4');
            $table->integer('answer');
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
        Schema::dropIfExists('userexams');
    }
}
