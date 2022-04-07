<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Notices extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create("notices", function (Blueprint $table) {
      $table->id();
      $table->uuid('uuid')->index();
      $table->string("title", 50);
      $table->text("body");
      $table->enum('type',['image','pdf','video','document']);
      $table->string("file");
      $table
        ->foreignId("user_id")
        ->references("id")
        ->on("users")
        ->onDelete("cascade");
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists("notices");
  }
}
