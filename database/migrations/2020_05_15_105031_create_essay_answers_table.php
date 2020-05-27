<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEssayAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('essay_answers', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('student_id')->unsigned();
            $table->foreign('student_id', 'fk_256_user_student_id_essay_answers')->references('id')->on('users');

            $table->integer('questionEssay_id')->unsigned();
            $table->foreign('questionEssay_id', 'fk_256_question_essay_questionEssay_id_essay_answers')->references('id')->on('question_essays');

            $table->float('given_mark');

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
        Schema::dropIfExists('essay_answers');
    }
}
