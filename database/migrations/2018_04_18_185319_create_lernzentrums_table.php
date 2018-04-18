<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLernzentrumsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lernzentrums', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('date');
            $table->text('info');
            $table->string('room');
            $table->integer('max_participants');
            $table->integer('teacher_id')->unsigned();
            $table->timestamps();

            $table->foreign('teacher_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lernzentrums');
    }
}
