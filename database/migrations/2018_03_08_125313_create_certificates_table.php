<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;


class CreateCertificatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {        
        Schema::create('certificates', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('doctor_id')->unsigned();
            $table->longText('name')->nullable('1');
            $table->longText('description')->nullable('1');
            $table->string('url');
             
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {     
        Schema::dropIfExists('certificates');
    }
}
