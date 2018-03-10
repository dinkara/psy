<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;


class CreateForeignKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('certificates', function (Blueprint $table) {
            $table->foreign('doctor_id')->references('id')->on('doctors')->onDelete('cascade');
       
        });
        Schema::table('doctors', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
       
        });
        Schema::table('messages', function (Blueprint $table) {
            $table->foreign('sender_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('receiver_id')->references('id')->on('users')->onDelete('cascade');
        });
        Schema::table('notes', function (Blueprint $table) {
            $table->foreign('session_id')->references('id')->on('sessions')->onDelete('cascade');
       
        });
        Schema::table('password_resets', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
       
        });
        Schema::table('patients', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
       
        });
        Schema::table('profiles', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
       
        });
        Schema::table('ratings', function (Blueprint $table) {
            $table->foreign('session_id')->references('id')->on('sessions')->onDelete('cascade');
       
        });
        Schema::table('ratings_questions', function (Blueprint $table) {
            $table->foreign('rating_id')->references('id')->on('ratings')->onDelete('cascade');
            $table->foreign('question_id')->references('id')->on('questions')->onDelete('cascade');
       
        });
        Schema::table('sessions', function (Blueprint $table) {
            $table->foreign('doctor_id')->references('id')->on('doctors')->onDelete('cascade');
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');
       
        });
        Schema::table('transactions', function (Blueprint $table) {
            $table->foreign('wallet_id')->references('id')->on('wallets')->onDelete('cascade');
            $table->foreign('session_id')->references('id')->on('sessions')->onDelete('cascade');
       
        });
        Schema::table('users_roles', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
       
        });
        Schema::table('users_social_networks', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('social_network_id')->references('id')->on('social_networks')->onDelete('cascade');
       
        });
        Schema::table('wallets', function (Blueprint $table) {
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
        Schema::table('certificates', function (Blueprint $table) {
            $table->dropForeign(['doctor_id']);

        });
        Schema::table('doctors', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['company_id']);

        });
        Schema::table('messages', function (Blueprint $table) {
            $table->dropForeign(['sender_id']);
            $table->dropForeign(['receiver_id']);
        });
        Schema::table('notes', function (Blueprint $table) {
            $table->dropForeign(['session_id']);

        });
        Schema::table('password_resets', function (Blueprint $table) {
            $table->dropForeign(['user_id']);

        });
        Schema::table('patients', function (Blueprint $table) {
            $table->dropForeign(['user_id']);

        });
        Schema::table('profiles', function (Blueprint $table) {
            $table->dropForeign(['user_id']);

        });
        Schema::table('ratings', function (Blueprint $table) {
            $table->dropForeign(['session_id']);

        });
        Schema::table('ratings_questions', function (Blueprint $table) {
            $table->dropForeign(['rating_id']);
            $table->dropForeign(['question_id']);

        });
        Schema::table('sessions', function (Blueprint $table) {
            $table->dropForeign(['doctor_id']);
            $table->dropForeign(['patient_id']);

        });
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropForeign(['wallet_id']);
            $table->dropForeign(['session_id']);

        });
        Schema::table('users_roles', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['role_id']);

        });
        Schema::table('users_social_networks', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['social_network_id']);

        });
        Schema::table('wallets', function (Blueprint $table) {
            $table->dropForeign(['user_id']);

        });

    }
}
