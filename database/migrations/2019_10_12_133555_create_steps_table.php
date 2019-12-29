<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStepsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('steps', function (Blueprint $table) {
            
          $table->bigIncrements('id');
          $table->string('title');
          $table->string('category_name');
          $table->string('naiyou0');
          $table->string('naiyou1');
          $table->string('naiyou2');
          $table->timestamps();
          
          /*
          $table->bigIncrements('id');
          $table->timestamps();
          $table->string('title');
          $table->string('achievement_time');
          */
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('steps');
    }
}
