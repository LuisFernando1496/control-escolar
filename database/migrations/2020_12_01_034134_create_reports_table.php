<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create("reports", function (Blueprint $table) {
			$table->id();
			$table->text("reason");
			$table
				->foreignId("student_id")
				->references("id")
				->on("students")
				->onDelete("cascade");
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
		Schema::dropIfExists("reports");
	}
}
