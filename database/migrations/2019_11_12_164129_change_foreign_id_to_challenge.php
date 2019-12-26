<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeForeignIdToChallenge extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('challenge', function (Blueprint $table) {

            $table->dropColumn('progress');
            $table->dropColumn('goal');
  
            $table->boolean('challenge_flg')->default(false);
            $table->boolean('delete_flg')->default(false);

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('step_id');
            $table->foreign('step_id')->references('id')->on('steps')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('challenge', function (Blueprint $table) {

            $table->integer('progress');
            $table->integer('goal');
            
            $table->dropColumn('challenge_flg');
            $table->dropColumn('delete_flg');

            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
            $table->dropForeign(['step_id']);
            $table->dropColumn('step_id');
        });
    }
}
