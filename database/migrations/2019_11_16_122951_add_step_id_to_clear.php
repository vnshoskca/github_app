<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStepIdToClear extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clear', function (Blueprint $table) {
            $table->unsignedBigInteger('step_id');
            //$table->foreign('step_id')->references('id')->on('steps')->onDelete('cascade');//祖父母と孫の関係のため、設定不可
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('clear', function (Blueprint $table) {
            //$table->dropForeign(['step_id']);
            $table->dropColumn('step_id');
        });
    }
}
