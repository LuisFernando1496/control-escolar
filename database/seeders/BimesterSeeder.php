<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Bimester;

class BimesterSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$bimesters = [
			["number" => 1, "description" => "Primer Bimestre"],
			["number" => 2, "description" => "Segundo Bimestre"],
			["number" => 3, "description" => "Tercer Bimestre"],
			["number" => 4, "description" => "Cuarto Bimestre"],
			["number" => 5, "description" => "Quinto Bimestre"],
			["number" => 6, "description" => "Sexto Bimestre"],
			["number" => 7, "description" => "Septimo Bimestre"],
			["number" => 8, "description" => "Octavo Bimestre"],
			["number" => 9, "description" => "Noveno Bimestre"],
			["number" => 10, "description" => "Decimo Bimestre"],
			["number" => 11, "description" => "Decimoprimero Bimestre"],
			["number" => 12, "description" => "Decimosegundo Bimestre"],
			["number" => 13, "description" => "Decimotercero Bimestre"],
			["number" => 14, "description" => "Decimocuarto Bimestre"],
			["number" => 15, "description" => "Decimoquinto Bimestre"],
			["number" => 16, "description" => "Decimosexto Bimestre"],
			["number" => 17, "description" => "Decimoséptimo Bimestre"],
			["number" => 18, "description" => "Decimoctavo Bimestre"],
		];

		foreach ($bimesters as $bimester) {
			Bimester::create($bimester);
		}
	}
}
