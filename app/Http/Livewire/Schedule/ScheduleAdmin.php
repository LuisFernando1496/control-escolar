<?php
namespace App\Http\Livewire\Schedule;
use App\Models\Schedule;
use App\Models\Day;

/**
 * operaciones que el administrador realiza
 */
trait ScheduleAdmin
{
	/**
	 * se encarga de ver si el administrador esta
	 * editando/creando un horario o si esta visualizando
	 * los horarios que existen en este año/periodo
	 *
	 * @var boolean
	 */
	public $isEditing = false; // mode crear horario | true => find horario

	public function findSchedule(int $grado, int $grupo)
	{
		return Schedule::where([
			["grade_id", "=", $grado],
			["group_id", "=", $grupo],
		])
			->whereIn("id", function ($query) {
				$query
					->from("schedules")
					->select("id")
					->whereYear("created_at", date("Y"))
					->get(); //get current year
			})
			->with("subject", "day", "teacher")
			->orderBy("begin")
			->orderBy("day_id")
			->get();
	}

	/**
	 * se verifica si el horario planteado existe
	 * para proceder a guardarlo
	 *
	 * @param integer $grado
	 * @param integer $grupo
	 * @return boolean
	 */
	public function existScheduleSaved(int $grado, int $grupo): bool
	{
		$exist = Schedule::where([
			["grade_id", "=", $grado],
			["group_id", "=", $grupo],
		])
			->whereIn("id", function ($query) {
				$query
					->from("schedules")
					->select("id")
					->whereYear("created_at", date("Y"))
					->get(); //get current year
			})
			->exists();

		if ($exist) {
			// si existe generar un exepcion ya que no se debe de dublicar la informacion
			throw new \Exception(
				"Se encuentra registrado un horario, para este grado y grupo"
			);
		}
		return true; // si no existe entonces proceder a salvar la informacion
	}

	/**
	 * se encarga de 
	 * generar un nuevo 
	 * Horario de clases
	 * schedule|store|save|generate
	 * @return void
	 */
	public function storeSchedule()
	{
		foreach ($this->schedule as $hora => $fila) {
			foreach ($fila as $dia => $horario) {
				Schedule::create([
					"teacher_id" => $this->maestro,
					"subject_id" => $horario["materia_id"],
					"day_id" => Day::where("name", $dia)->first()->id,
					"group_id" => $this->grupo,
					"grade_id" => $this->grado,
					"begin" => $horario["inicio"],
					"end" => $horario["fin"],
				]);
			}
		}
	}

/**
 * la inscripcion de todos los grupos y grados
 *
 * @return void
 */
	public function fuckingSubscription()
	{
		
		try {
			$inscribir = new InscribirAlumnos();
			$inscribir->notAllSchedules(); //expeption si no hay hosrios para los alumnos
			$inscribir->inscribir();  // is alumnos == 0 | return exeption
			$this->emit("show-toast", "Inscripcion", "Se ha inscrito los alumnos a su horario correspondiente", "success");
		} catch (\Exception $e) { // manejando el error 
			$this->emit("show-toast", "Inscripcion", $e->getMessage(), "warning");
		}
		
		// $this->emit("show-toast", "Inscripcion", "Se ha incrito todos los alumnos a su horario correspondiente", "success");
	}
	public function makeSchedule($schedule)
	{
		Day::all()->each(function ($dia) use($schedule){
			$timeStart = "08:00:00";
			$m = 0;
			while ($m <= 6) {
				if ($timeStart == "11:00:00") {
					$timeEnd = date("H:i:s", strtotime($timeStart . "+30 minutes"));
					//configurar las horas
					$this->schedule[$m][$dia->name]["inicio"] = $timeStart;
					$this->schedule[$m][$dia->name]["fin"] = $timeEnd;
				} else {
					$timeEnd = date("H:i:s", strtotime($timeStart . "+1 hour"));
					//configurar las horas
					$this->schedule[$m][$dia->name]["inicio"] = $timeStart;
					$this->schedule[$m][$dia->name]["fin"] = $timeEnd;
				}
				if (empty($this->schedule[$m][$dia->name])) {
					$this->schedule[$m][$dia->name] = null;
				}

				//iterar los resultados de la quey
				$schedule->each(function ($schedule) use (
					$timeStart,
					$timeEnd,
					$dia,
					$m
				) {
					//si en este hora y dias hace match entonces ponerlo
					if (
						$dia->id == $schedule->day->id &&
						$timeStart == $schedule->begin
					) {
						$this->schedule[$m][$dia->name]["materia"] =
							$schedule->subject->name;
						$this->schedule[$m][$dia->name]["materia_id"] =
							$schedule->subject->id;
						return false;
					}
				});
				$m++;
				$timeStart = $timeEnd;
			}
		});
	}
}
