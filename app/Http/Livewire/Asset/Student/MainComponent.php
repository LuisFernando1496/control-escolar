<?php

namespace App\Http\Livewire\Asset\Student;

use Livewire\Component;
use App\Models\Subject;
use App\Models\User;
use App\Models\Asset;
use App\Models\Schedule;

use Illuminate\Support\Collection;

use Illuminate\Support\Facades\DB;

class MainComponent extends Component
{
	public $subjects = [];
	public $assets;
	public $materiaQuery = "";
	protected $queryString = [
		"materiaQuery" => ["except" => ""],
	];
	public function mount()
	{
		\Gate::authorize("hasRole", "alumno"); //only student can access
		/**
		 * this query find subject that student has
		 * relation with 3 tables and the last
		 * one table to get the object of one by one
		 * the subject to  be stored in an array
		 */
		//LastBimester solicita el id del estudiante para saber su ultimo semestre
		$this->subjects = User::where("id", \Auth::user()->id)
			->first()
			->student->scores()
			->LastBimester(\Auth::user()->student->id)
			->get()
			->map(function ($score) {
				return $score->subject;
			});
		//filtar la informacion, ya que tenemos el horario solo queremos las materias de la semana
		$this->materiaQuery =
			$this->subjects->count() > 0 ? $this->subjects[0]["name"] : "";
	}
	public function render()
	{
		//find assets of the currently selected material by the [query params]
		$query = Subject::where("name", $this->materiaQuery);
		$this->assets = $query->count() > 0 ? $query->first()->assets : [];

		return view("livewire.asset.student.main-component", [
			"materias" => $this->subjects,
		]);
	}

	/**
	 * update the query params with
	 * the subject tab selected
	 *
	 * @param array $materia
	 * @return void
	 */
	public function navigate($materia)
	{
		$this->materiaQuery = $materia["name"];
	}
}
