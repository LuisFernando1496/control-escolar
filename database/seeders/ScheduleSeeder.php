<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Schedule;
use App\Models\Role;
use App\Models\Group;
use App\Models\Day;
use App\Models\Grade;
use App\Models\Score;
use App\Models\Subject;
class ScheduleSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		///get all users who are teachers
		$maestro = Role::where("slug", "=", "docente")->first()->users->first(); //actually 3 teachers

		$materias = Subject::where("grade_id", 1)->get();
		$grado = Grade::where("id", 1)->first();

		$days = Day::all();
		$grupo = Group::find(1);
		$grado = Grade::find(1);
		foreach ($days as $key => $day) {
			$timeStart = "08:00:00"; //hora de inicio de clases
			$m = 1;
			while ($m <= 7) {
				$horario = new Schedule();
				if ($timeStart == "11:00:00") {
					$timeEnd = date("H:i:s", strtotime($timeStart . "+30 minutes"));
					$horario = Schedule::create([
						"teacher_id" => $maestro->id,
						"subject_id" => $materias->where("key", "receso")->first()->id,
						"day_id" => $day->id,
						"group_id" => $grupo->id,
						"grade_id" => $grado->id,
						"begin" => $timeStart,
						"end" => $timeEnd,
						// "created_at" => date(strtotime( date('Y-m-d H:i:s') .  '+1 Year')) //format timestap |
					]);
				} else {
					$timeEnd = date("H:i:s", strtotime($timeStart . "+1 hour"));
					$horario = Schedule::create([
						"teacher_id" => $maestro->id,
						"subject_id" => $materias
							->filter(function ($value, $key) {
								return $value->key != "receso";
							})
							->random()->id,
						"day_id" => $day->id,
						"group_id" => $grupo->id,
						"grade_id" => $grado->id,
						"begin" => $timeStart,
						"end" => $timeEnd,
						// "created_at" => date(strtotime( date('Y-m-d H:i:s') .  '+1 Year')) //format timestap |
					]);
                }
                $m++;
				$timeStart = $timeEnd;
			}
		}
	}
	public function alumnosSubcripToSchedule(
		$schedule,
		$bimester,
		$numberStudents = 10
	) {
		for ($i = 0; $i < $numberStudents; $i++) {
			Score::factory()->create([
				"bimester_id" => $bimester,
				"schedule_id" => $schedule->id,
			]);
		}
	}
}
