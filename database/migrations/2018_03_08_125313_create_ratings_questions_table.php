<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;


class CreateRatingsQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {        
        Schema::create('ratings_questions', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('rating_id')->unsigned();
            $table->integer('question_id')->unsigned();
            $table->integer('mark')->default(0)->unsigned('1');
             
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {     
        Schema::dropIfExists('ratings_questions');
    }
}
