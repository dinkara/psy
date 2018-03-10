<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Support\Enum\SessionStatuses;


class CreateSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {        
        Schema::create('sessions', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('doctor_id')->unsigned();
            $table->integer('patient_id')->unsigned();
            $table->double('price',10,2)->default(0.0);
            $table->dateTime('start');
            $table->dateTime('end');
            $table->enum('status' ,SessionStatuses::all())->default(SessionStatuses::SCHEDULED);
             
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {     
        Schema::dropIfExists('sessions');
    }
}
