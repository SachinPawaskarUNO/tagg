<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSecurityquestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('securityquestions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('question1');
            $table->string('answer1');
            $table->string('question2');
            $table->string('answer2');
            $table->string('question3');
            $table->string('answer3');
            $table->integer('user_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('securityquestions', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('securityquestions');
    }
}
