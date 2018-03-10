<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Support\Enum\TransactionStatuses;


class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {        
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('wallet_id')->unsigned();
            $table->integer('session_id')->unsigned();
            $table->double('amount',10,2)->default(0.0);
            $table->longText('comment')->nullable('1');
            $table->enum('status' ,TransactionStatuses::all())->default(TransactionStatuses::PENDING);
             
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {     
        Schema::dropIfExists('transactions');
    }
}
