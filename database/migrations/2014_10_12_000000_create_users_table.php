<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create("users", function (Blueprint $table) {
      $table->id();
      $table->string("name");
      $table->string("lastname1");
      $table->string("lastname2");
      $table->string("rfc")->nullable();
      $table->string("curp")->nullable();
      $table->string("key",8)->unique();
      $table->string("phone",10)->unique();
      $table->string("email")->unique();
      $table->boolean("sex");
      $table->boolean("active");
      $table->date("birthday");
      $table->timestamp("email_verified_at")->nullable();
      $table->string("password");
      $table->rememberToken();
      $table->foreignId("current_team_id")->nullable();
      $table->text("profile_photo_path")->nullable();
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
    Schema::dropIfExists("users");
  }
}
