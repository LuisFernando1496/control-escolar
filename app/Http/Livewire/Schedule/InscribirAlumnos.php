<?php
namespace App\Http\Livewire\Schedule;
use App\Models\Schedule;
use App\Models\Student;
use App\Models\Score;
use App\Models\Record;

class InscribirAlumnos extends verifySchedules
{
	public const ACTIVE = 0; // el alumno no ha conlcuido la secundaria
	public function __constructor()
	{
		//que pongo aqui 🤧
	}

	public function inscribir()
	{
		$context = $this;
		$students = $this->getStudents();
		//si es vacio
		if ($students->count() <= 0) {
			throw new \Exception("No tiene alumnos por inscribir a un horario");
		} else {
			$this->getSchedules()->each(function ($horario) use (
				$students,
				$context
			) {
				$students
					->filter(function ($query) use ($horario) {
						return $query->current_grade_id == $horario->grade_id &&
							$query->current_group_id == $horario->group_id;
					})
					->each(function ($student) use ($horario, $context) {
						// \Log::debug('testing');
						$student->schedules()->attach($horario->id);
						$context->scoreOneYear(
							$student,
							$horario,
							$student->current_grade_id
						);
					});
			});
			return true;
		}
	}

	public function scoreOneYear($student, $schedule, $currentYear)
	{
		$bimestre = $currentYear == 1 ? 1 : ($currentYear == 2 ? 7 : 13); // 13 ultimo año
		$bimestreEnd = $currentYear == 1 ? 6 : ($currentYear == 2 ? 12 : 18);
		while ($bimestre <= $bimestreEnd) {
			if($schedule->subject->key != 'receso'){ //a todas que no sean receso
				$this->createScore($student, $schedule->subject, $bimestre); 
			}
			$bimestre++;
		}
	}

	public function createScore($student, $subject, $bimestre)
	{
		$bimestreSubject = Score::where([
			["subject_id", "=", $subject->id],
			["student_id", "=", $student->id],
			["bimester_id", "=", $bimestre],
		])->exists();
		if (!$bimestreSubject) {
			//no existe como ella
			$score = Score::create([
				"bimester_id" => $bimestre,
				"subject_id" => $subject->id,
				"student_id" => $student->id,
			]);
		}
	}

	public function getSchedules()
	{
		return Schedule::whereIn("id", function ($query) {
			$query
				->from("schedules")
				->select("id")
				->whereYear("created_at", date("Y")) //current year
				->get();
		})
			->with('subject')
			->orderBy("grade_id", "asc")
			->orderBy("group_id", "asc")
			->orderBy("begin")
			->orderBy("day_id")
			->get();
	}

	public function getStudents()
	{
		return Student::where("end", 0)
			->whereNotIn("id", function ($query) {
				$query
					->from("schedule_student")
					->select("student_id")
					->whereYear("created_at", date("Y"))
					->get();
			})
			->orderBy("current_grade_id")
			->orderBy("current_group_id")
			->get();
	}
}
