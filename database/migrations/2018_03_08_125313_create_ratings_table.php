<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Support\Enum\RatingOwners;


class CreateRatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {        
        Schema::create('ratings', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('session_id')->unsigned();
            $table->longText('comment')->nullable('1');
            $table->enum('owner' ,RatingOwners::all())->default(RatingOwners::DOCTOR);
            $table->double('avg_rate',10,2)->default(0.0);
             
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {     
        Schema::dropIfExists('ratings');
    }
}
