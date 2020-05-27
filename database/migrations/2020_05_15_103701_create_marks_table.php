<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMarksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('marks', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('student_id')->unsigned();
            $table->foreign('student_id', 'fk_256_user_student_id_marks')->references('id')->on('users');

            $table->integer('exam_id')->unsigned();
            $table->foreign('exam_id', 'fk_256_exam_exam_id_marks')->references('id')->on('exams');
            $table->integer('test_id')->unsigned();

            $table->float('grade');

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
        Schema::dropIfExists('marks');
    }
}
