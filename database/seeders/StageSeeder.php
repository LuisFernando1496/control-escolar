<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Stage;
use Carbon\Carbon;

class StageSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Stage::create([
			"deadline" => Carbon::now()->addDays(25)->toDateString(),
			"active" => false,
			"slug" => "regist",
			"description" => "Inscripción de Alumnos",
		]);
		Stage::create([
			"deadline" => Carbon::now()->addDays(20)->toDateString(),
			"active" => false,
			"slug" => "update",
			"description" => "Reinscripción de Alumnos",
		]);
	}
}
