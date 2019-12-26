<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddToKosteps extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kosteps', function (Blueprint $table) {
            $table->string('content');
            $table->string('detail_content');
            $table->boolean('cleared_flg')->default(false);
            $table->boolean('delete_flg')->default(false);
            $table->unsignedBigInteger('step_id');
            $table->foreign('step_id')->references('id')->on('steps');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('kosteps', function (Blueprint $table) {
            $table->dropColumn('content');
            $table->dropColumn('detail_content');
            $table->dropColumn('cleared_flg');
            $table->dropColumn('delete_flg');
            $table->dropForeign(['step_id']);
            $table->dropColumn('step_id');
        });
    }
}
