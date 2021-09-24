<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuizResultTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quiz_results', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('quiz_id');
            $table->unsignedBigInteger('user_id');
            $table->integer("total_attempt")->default(0);
            $table->integer("total_right")->default(0);
            $table->integer("total_wrong")->default(0);
            $table->boolean('is_pass')->default(false);
            $table->timestamps();
            $table->tinyInteger('status')->default('1');

            $table->foreign('quiz_id')->references('id')->on('quizzes')->constrained();
            $table->foreign('user_id')->references('id')->on('users')->constrained();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('quiz_results', function (Blueprint $table) {
            $table->dropForeign(['quiz_id']);
            $table->dropForeign(['user_id']);
        });
        Schema::dropIfExists('quiz_results');
    }
}
