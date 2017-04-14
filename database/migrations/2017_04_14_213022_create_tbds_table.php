<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbdsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
      Schema::create('tbds', function (Blueprint $table) {
          $table->increments('id');
          $table->string('text');
          $table->unsignedInteger('userId');
          $table->foreign('userId')->references('id')->on('users');
      });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
      Schema::dropIfExists('tbds');
  }
}
