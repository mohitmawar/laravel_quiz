<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuizQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quiz_questions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('quiz_id');
            $table->integer('counter');
            $table->text('question')->nullable();
            $table->json('options')->nullable();
            $table->json('answers')->nullable();
            $table->timestamps();
            $table->tinyInteger('status')->default('1');

            $table->foreign('quiz_id')->references('id')->on('quizzes')->constrained();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('quiz_questions', function (Blueprint $table) {
            $table->dropForeign(['quiz_id']);
        });
        Schema::dropIfExists('quiz_questions');
    }
}
