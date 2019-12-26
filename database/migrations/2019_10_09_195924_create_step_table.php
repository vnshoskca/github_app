<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStepTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('step', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->string('title');
          $table->string('category_name');
          $table->string('naiyou0');
          $table->string('naiyou1');
          $table->string('naiyou2');
          $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.mysql
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('step');
    }
}
