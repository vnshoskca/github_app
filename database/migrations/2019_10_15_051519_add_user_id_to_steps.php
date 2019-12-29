<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserIdToSteps extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('steps', function (Blueprint $table) {
            Schema::table('steps', function (Blueprint $table) {
                DB::statement('DELETE FROM steps');//テーブル削除
                $table->unsignedBigInteger('user_id');
                $table->foreign('user_id')->references('id')->on('users');
            });
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        /*
        Schema::table('steps', function (Blueprint $table) {
            Schema::table('steps', function (Blueprint $table) {
                $table->dropForeign(['user_id']);
                $table->dropColumn('user_id');
            });
        });
        */
    }
}
