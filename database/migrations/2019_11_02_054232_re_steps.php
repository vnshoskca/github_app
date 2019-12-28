<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ReSteps extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('steps', function (Blueprint $table) {
            /*
            $table->boolean('challenged_flg')->default(false);
            $table->string('achievement_time');///////////
            */
            $table->renameColumn('naiyou0', 'achievement_time');
            $table->dropColumn('naiyou1');
            $table->dropColumn('naiyou2');
            $table->boolean('delete_flg')->default(false);
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
            /*
            Schema::table('steps', function (Blueprint $table) {/////////
                $table->dropForeign(['category_id']);
                $table->dropColumn('category_id');
            });
            $table->renameColumn('achievement_time', 'naiyou0');
            $table->string('naiyou1');
            $table->string('naiyou2');
            $table->dropColumn('challenged_flg');
            $table->dropColumn('twitter_flg');
            $table->dropColumn('delete_flg');
            $table->unsignedBigInteger('user_id');
            */
            $table->renameColumn('achievement_time', 'naiyou0');
            $table->string('naiyou1');
            $table->string('naiyou2');
            $table->dropColumn('delete_flg');
        });
    }
}
