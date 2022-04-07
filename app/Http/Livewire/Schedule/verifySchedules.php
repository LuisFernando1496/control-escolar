<?php
namespace App\Http\Livewire\Schedule;
use App\Models\Schedule;
use App\Models\Student;

class verifySchedules
{
	/**
	 * verificara que se encuentre horarios generados para cada
	 * grado y grupo
	 * 1A
	 * 2A
	 * 3B
	 * @return Exception
	 */
	public function notAllSchedules()
	{
		$current = $this->getCurrentsGrades();
		$current->each(function ($profile) {
			$schedule = Schedule::select("id")
				->whereYear("created_at", date("Y")) //current year
				->where([
					["grade_id", $profile->current_grade_id],
					["group_id", $profile->current_group_id],
				])
				->exists();

			if (!$schedule) {
				// false entonces
				throw new \Exception(
					"Hace falta un horario para el grado " .
						$profile->current_grade_id .
						"" .
						$profile->currentGroup->name .
						", Por favor, registre para poder continuar."
				);
				// throw new \Exception("Hace falta un horario para un un grado y grupo");
			}
		});
		return true;
	}

	/**
	 * buscara que grados y grupos son los actuales
	 * para ser el criterio de busqueda para el horario
	 *
	 * @return array
	 */
	public function getCurrentsGrades():object 
	{
		return Student::select("current_grade_id", "current_group_id")
			->whereYear("created_at", date("Y"))
			->where("end", 0)
			->distinct()
			->orderBy("current_grade_id")
			->orderBy("current_group_id")
			->with("currentGroup")
			->get();
	}
}
