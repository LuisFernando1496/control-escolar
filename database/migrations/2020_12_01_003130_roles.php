<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Roles extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create("roles", function (Blueprint $table) {
			$table->id();
			$table->string("name")->unique();
			$table->string("slug")->unique()->nullable();
			$table->text("description")->nullable();
			$table->enum("full_access", ["yes", "no"])->nullable();
			$table->boolean("active");
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
		Schema::dropIfExists("roles");
	}
}
