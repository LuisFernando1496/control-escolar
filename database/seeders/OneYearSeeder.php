<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Schedule;
use App\Models\Subject;
use App\Models\Group;
use App\Models\Grade;
use App\Models\Day;
use App\Models\Role;

use App\Models\Score;
use App\Models\Record;
use App\Models\Student;
class OneYearSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public $scheduleDay = [];
	public function run()
	{
		$grupo = Group::first();
		$maestro = Role::where("slug", "=", "docente")
			->first()
			->users->first();
		//conjunto de alumnos solo 5
		$estudiantes = Student::factory(1)->create([
			"current_grade_id" => 1, //segundo año porque termino
			"current_group_id" => $grupo->id, //grupo A
		]);
		//asignar el role
		$role = Role::where("slug", "alumno")->first();
		$estudiantes->each(function ($student) use ($role) {
			$student->user->roles()->attach($role->id);
		});
		// $estudiantes = Student::latest()->take(5)->get(); //optener los ultimos 5 datos de una entidad

		for ($currentYear = 1; $currentYear <= 3; $currentYear++) {
			//materias de primer grado
			$materias = Subject::where("grade_id", $currentYear)->get();
			$grado = Grade::where("id", $currentYear)->first();
			//por cada dia se llevan 7 materias
			Day::all()->each(function ($dia) use (
				$maestro,
				$materias,
				$grupo,
				$grado,
				$currentYear,
				$estudiantes
			) {
				$timeStart = "08:00:00"; //hora de inicio de clases
				$m = 1;
				while ($m <= 7) {
					// 7 materias al dia
					$horario = new Schedule;
					if($timeStart == '11:00:00'){
						$timeEnd = date("H:i:s", strtotime($timeStart . "+30 minutes"));
						$horario = Schedule::create([
						"teacher_id" => $maestro->id,
						"subject_id" => $materias->where('key', 'receso')->first()->id,
						"day_id" => $dia->id,
						"group_id" => $grupo->id,
						"grade_id" => $grado->id,
						"begin" => $timeStart,
						"end" => $timeEnd,
						// "created_at" => date(strtotime( date('Y-m-d H:i:s') .  '+1 Year')) //format timestap |
						]);
					}else{
						$timeEnd = date("H:i:s", strtotime($timeStart . "+1 hour"));
						$horario = Schedule::create([
						"teacher_id" => $maestro->id,
						"subject_id" => $materias->filter(function ($value, $key) { return $value->key != 'receso'; })->random()->id,
						"day_id" => $dia->id,
						"group_id" => $grupo->id,
						"grade_id" => $grado->id,
						"begin" => $timeStart,
						"end" => $timeEnd,
						// "created_at" => date(strtotime( date('Y-m-d H:i:s') .  '+1 Year')) //format timestap |
					]);
					}
					
					
					
					//antes que finalice actutualizar las variables
					$m++;
					$timeStart = $timeEnd;
					// array_push($this->scheduleDay, $horario->id);
					$this->inscribir($horario, $estudiantes, $currentYear);
				}
				// $this->scheduleDay = [];
			});
			//verifcar que sea un ciclo conluido
			$this->recordPerStudent($estudiantes, $grado);
		}
	}

	public function inscribir($horario, $estudiantes, $currentYear)
	{
		foreach ($estudiantes as $key => $estudiante) { // 5 student * 6 (un año)
			$bimestre = $currentYear == 1 ? 1 : ( $currentYear == 2 ? 7 : 13); // 13 ultimo año
			$bimestreEnd = $currentYear == 1 ? 6 : ( $currentYear == 2 ? 12 : 18);;
			while ($bimestre <= $bimestreEnd) {
				//aqui transcurre un año escolars por cada materia
				// el score el por materia y por bimestre de la materia
				$estudiante->schedules()->attach($horario->id);
				$this->scorePerBimester($bimestre, $horario, $estudiante);
				$bimestre++;
			}
		}
	}

	public function scorePerBimester($bimestre, $horario, $estudiante)
	{
		$bimestreSubject = Score::where([
			["subject_id", "=", $horario->subject_id],
			["student_id", "=", $estudiante->id],
			["bimester_id", "=", $bimestre],
		])->first();
		if ($bimestreSubject == null) {
			Score::factory()->create([
				"bimester_id" => $bimestre,
				"subject_id" => $horario->subject_id,
				"approved" => true,
				"student_id" => $estudiante->id,
			]);
		}
	}

	/**
	 * Un record se generar cuando el alumno a  finalizado un año o ciclo school
	 *
	 * @param [type] $horario
	 * @param [type] $estudiante
	 * @return void
	 */
	public function recordPerStudent($estudiantes, $grado)
	{
		$estudiantes->each(function ($estudiante) use ($grado) {
			$estudiante->update(["current_grade_id" => $grado->id]);
			Record::create([
				"score" => Student::where("id", $estudiante->id)
					->first()
					->yearAverage(),
				"grade_id" => $estudiante->current_grade_id, //para saber en de que año es la calficacion
				"group_id" => $estudiante->current_group_id,
				"student_id" => $estudiante->id,
			]);
		});
	}
}
