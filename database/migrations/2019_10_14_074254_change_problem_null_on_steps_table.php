<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeProblemNullOnStepsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('steps', function (Blueprint $table) {
            $table->string('naiyou1')->nullable()->change();
            $table->string('naiyou2')->nullable()->change();
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
          $table->string('naiyou1')->nullable(false)->change();
          $table->string('naiyou2')->nullable(false)->change();
        });
        */
    }
}
