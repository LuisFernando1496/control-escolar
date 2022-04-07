<?php

namespace App\Http\Livewire\Schedule;

use Livewire\Component;

use App\Models\Subject;
use App\Models\Day;
use App\Models\Role;

use App\Models\Schedule;
use App\Models\School;
use App\Models\Group;
use App\Models\Grade;
use App\Models\Student;
use App\Models\Stage;

use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Storage;
 use Response;

use Carbon\Carbon;

class ScheduleComponent extends Component
{
	use ScheduleAdmin; //trait para admin
	public $grado = 0,
		$grupo = 0,
		$maestro;
	public $materia;
	public $isComplete = true; //variable que se vuelve true cuando el horario este lleno
	public $canGenerate = true; //para el boton de poder generar pdf
	public $materias, $teaches;
	//posicion - hora - dia
	public $schedule = [[], []];
	public $timeStart = "07:00";

	/**
	 * contiene si es Admin | docente | alumno
	 * @var string
	 */
	public $whoIs = "";

	//variables para alumno
	public $studenSchedule;
	//variable para el docente que solo imparte una clase
	public $teacherSchadule;
	public $adminSchedule;
	public $onPeriod = false;
	protected $rules = [
		"grupo" => "required",
		"grado" => "required",
		"maestro" => "required",
	];

	public function render()
	{
		
		if ($this->whoIs == "admin") {
			if ($this->isEditing) { // modo busqueda
				  if(($this->grado != 0) && ($this->grupo != 0)){
						$this->adminSchedule = $this->findSchedule($this->grado, $this->grupo);
						if($this->adminSchedule->count() > 0){ // horario no vacio
							$this->maestro =  $this->adminSchedule[0]->teacher->id;
							$this->makeSchedule($this->adminSchedule);
							$this->canGenerate = $this->isScheduleDone() == true ? true : false;
						}else{
							$this->schedule = [[], []];
							$this->setBaseSchedule();
							$this->canGenerate = $this->isScheduleDone() == true ? true : false;
						}
					}
			}else{
				$scope = $this;
				$this->setBaseSchedule();
				$this->materias = Subject::when($this->grado != 0, function (
				$subject
			) use ($scope) {
				$subject->where("grade_id", "=", $scope->grado);
			})->get();
			}
		} elseif ($this->whoIs == "docente") {

			/**
			 * Question | pregunta
			 * ¿l docente que tendra un horario este mismo solo le impartira curso a un solo 
			 * grupo por un año, no tendra n grupos por ano?
			 */
			$scope = $this;
			if(($this->grado != 0) && ($this->grupo != 0)){
					$this->teacherSchedule = Schedule::when(
					$this->grupo != 0,
					function ($query) use ($scope) {
						$query
							->where([
								["grade_id", "=", $scope->grado],
								["group_id", "=", $scope->grupo],
								["teacher_id", "=", auth()->user()->id],
							])
							->whereIn("id", function ($query) {
								$query->from('schedules')
								->select("id")
								->whereYear('created_at', date('Y') )->get(); //get current year
								})->with("subject", "day");
					}
				)->orderBy("begin")
				->orderBy("day_id")
				->get();
			// dd($this->teacherSchedule);
			if ($this->teacherSchedule->count() == 35) {
					$this->setBaseTeacherSchedule();
					// dd($this->teacherSchedule);
					$this->canGenerate = $this->isScheduleDone() == true ? true : false;
			}else{
				$this->schedule = [[], []];
				$this->setBaseSchedule();
				$this->canGenerate = $this->isScheduleDone() == true ? true : false;
			}
			}
			
			
		}
		return view("livewire.schedule.schedule-component");
	}
	public function mount()
	{
		$this->whoIs = auth()
			->user()
			->displayRole();
		switch ($this->whoIs) {
			case "admin":
				$this->teaches = Role::where("slug", "docente")
					->first()
					->users()
					->get();
				$this->setBaseSchedule();
				$this->maestro == 1;
				$this->onPeriod = Stage::select('active')->where('slug', 'regist')->first()->active;
				break;
			case "alumno":
				$this->studenSchedule = Schedule::where([
					["group_id", auth()->user()->student->current_group_id],
					["grade_id", auth()->user()->student->current_grade_id],
				])
					->whereIn("id", function ($query) {
						$query
							->from("schedule_student")
							->select("schedule_id")
							->where("student_id", auth()->user()->student->id)
							->get();
					})
					->orderBy("begin")
					->orderBy("day_id")
					->get();
				// dd($this->studenSchedule);
				$this->setBaseStudentSchedule();
				$this->grado = auth()->user()->student->current_grade_id;
				$this->grupo = auth()->user()->student->current_group_id;
				break;
			case "docente":
				$this->setBaseSchedule();
				break;
				
			case "tutor": //modificacion para que el tutor pueda visualizar el horario de su hijo
				$user = Student::where('tutor_id', auth()->user()->id)->first();
				$this->studenSchedule = Schedule::where([
				["group_id", $user->user->student->current_group_id],
				["grade_id", $user->user->student->current_grade_id],
			])
				->whereIn("id", function ($query) {
					$user = Student::where('tutor_id', auth()->user()->id)->first();
					$query
						->from("schedule_student")
						->select("schedule_id")
						->where("student_id", $user->user->student->id)
						->get();
				})
				->orderBy("begin")
				->orderBy("day_id")
				->get();
			// dd($this->studenSchedule);
			$this->setBaseStudentSchedule();
			$this->grado = $user->user->student->current_grade_id;
			$this->grupo = $user->user->student->current_group_id;
			
			break;
		}
	}

	/**
	 * cada vez que se le va asignar una
	 * materia a un hora y dia, este
	 * metodo se encarga de asignarlo
	 *
	 * @param [integer] $hora
	 * @param [string] $dia
	 * @return void
	 */
	public function materiaSelect($hora, $dia)
	{
		$validatedData = $this->validate(
			["materia" => "required"],
			[
				"materia.required" =>
					"NO! ha seleccionado ninguna :attribute para poder agregar al horario.",
			]
		);

		$materia = $this->materias->where("id", $this->materia)->first();

		$this->schedule[$hora][$dia]["materia"] = $materia->name;
		$this->schedule[$hora][$dia]["materia_id"] = $materia->id;
		$this->isComplete = $this->isScheduleDone() == true ? true : false;
	}

	/**
	 * Salvar | Guardar horario
	 * @return void
	 */
	public function store()
	{
		$this->validate();
		try {
			// verificar que no exista un grupo y grado registrado
			$this->existScheduleSaved($this->grado, $this->grupo);
			//si no hay entonces generar HORARIO
			$this->storeSchedule();
			$this->emit("show-toast", "Horario", "Se ha creado con exito.", "success");
		} catch (\Exception $e) {
			$this->emit("show-toast", "Horario", $e->getMessage() , "warning");
		}
	}
	/**
	 * metodo que se encarga de guenerar un
	 * horario base con horas y dias
	 *
	 * @return void
	 */
	public function setBaseSchedule()
	{
		Day::all()->each(function ($dia) {
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
				// if (empty($this->schedule[$m][$dia->name])) {
				// 	$this->schedule[$m][$dia->name] = null;
				// }
				// $this->schedule[$m][$dia->name]["materia"] =  null;
				// $this->schedule[$m][$dia->name]["materia_id"] = null;
				$m++;
				$timeStart = $timeEnd;
			}
		});
		// dd($this->schedule);
	}

	/**
	 * metodo de lleneado del
	 * horario de clases del alumno
	 * no optimizado - 
	 * @return void
	 */
	public function setBaseStudentSchedule()
	{
		Day::all()->each(function ($dia) {
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
				$this->studenSchedule->each(function ($item) use (
					$timeStart,
					$timeEnd,
					$dia,
					$m
				) {
					//si en este hora y dias hace match entonces ponerlo
					if ($dia->id == $item->day->id && $timeStart == $item->begin) {
						$this->schedule[$m][$dia->name]["materia"] = $item->subject->name;
						$this->schedule[$m][$dia->name]["materia_id"] = $item->subject->id;
					}
				});
				$m++;
				$timeStart = $timeEnd;
			}
		});
		$this->canGenerate = $this->isScheduleDone() == true ? true : false;
	}
	/**
	 * metodo de lleneado del
	 * horario de clases del alumno
	 *
	 * @return void
	 */
	public function setBaseTeacherSchedule()
	{
		Day::all()->each(function ($dia) {
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
					// $this->schedule[$m][$dia->name] = null;
				}

				//iterar los resultados de la quey
				$this->teacherSchedule->each(function ($schedule) use (
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

	public function generatePDF()
	{
	 
			$school = School::first();
		$schedules = $this->schedule;
		$grade = Grade::where('id', $this->grado)->first();
		$group = Group::where('id', $this->grupo)->first();
		$date = Carbon::now();
		$pdf = PDF::loadView(
				"documents.schedule",
				compact("schedules", "school", "grade", "group", "date")
			)->setPaper('a4', 'landscape');
			return response()->streamDownload(function () use($pdf) {
				echo $pdf->stream();
			}, 'horario.pdf');
	}

	/**
	 * isSchedul full |
	 * verifica que el horario que se este editando
	 * se encuentre totalmente llena, de lo contrario
	 * no se permite, que se salve
	 *
	 * @return boolean
	 */
	public function isScheduleDone()
	{
		foreach ($this->schedule as $key => $hora) {
			// 6
			foreach ($hora as $key => $dia) {
				if (empty($dia["materia"])) {
					return true; // es decir boton desactivado
				}
			}
		}
	}
}
