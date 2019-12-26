<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemakeSteps extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('steps', function (Blueprint $table) {
            $table->dropColumn('title');
            //$table->dropColumn("achievement_time");
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');

            $table->dropForeign(['category_id']);
            $table->dropColumn('category_id');

            $table->dropColumn('challenged_flg');
            $table->dropColumn('twitter_flg');
            $table->dropColumn('delete_flg');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('steps', function (Blueprint $table) {
            $table->string('title');
            //$table->string("achievement_time");
            $table->boolean('challenged_flg')->default(false);
            $table->boolean('twitter_flg')->default(false);
            $table->boolean('delete_flg')->default(false);

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');

            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('category');
        });
    }
}