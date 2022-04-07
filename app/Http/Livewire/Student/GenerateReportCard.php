<?php
namespace App\Http\Livewire\Student;
use App\Models\Student;
use App\Models\School;
use Barryvdh\DomPDF\Facade as PDF;
use Response;
trait GenerateReportCard
{
	public $showReportCard = false;

	/**
	 * variables para generar la boletas
	 * de un grupo
	 *
	 * @var int grupo del alumno
	 * @var int grado del alumno
	 * @var date year que se inicio el ciclo
	 */
	public $rGroup, $rGrade, $period;
	public $periods;

	public function makeReportCard()
	{
		// validacion de informacion
		$formValidate = $this->validate(
			["rGroup" => "required", "rGrade" => "required", "period" => "required"],
			[
				"rGroup.required" => "El campo grupo no debe de estar vacio",
				"rGrade.required" => "El campo Grado no debe de estar vacio",
				"period.required" => "El campo periodo no debe de estar vacio",
			]
		);

		// "period" => "required",
		// looking for student that complete with the criteria
		$students = Student::where([
			["current_group_id", $this->rGroup],
			["current_grade_id", $this->rGrade],
			["end", 0]
		])->whereIn("id", function ($query) { //optoner a estudiante que esten incritos
				$query
					->from("schedule_student")
					->select("student_id")
					->whereYear("created_at", date("Y"))
					->get();
			})
			->whereYear("period", "=", $this->period)
			->with("user", "currentGroup")
			->get();

		if ($students->count() > 0) { //verify that student don't be empty
			// get all score per Subject & get the final socre 
			$students = $students->each(function ($es) {
				$es->schedules
					->unique("subject_id")
					->each(function ($materia) use ($es) {
						$es[$materia->subject->key] = round(
							$materia->subject->scores->avg("score"),
							2
						); //para que solo imprima 2 decimales
					});
				$es["final"] = round($es->scores->avg("score"), 2); // conocer el promedio actual
				$es['date'] = $es->scores->first()->created_at;
			});

			$school = School::findOrFail(1)->first();
			$pdf =  PDF::loadView(
				"documents.report.report-card",
				compact("students", "school")
			)->setPaper('a4', 'portrait');
			return response()->streamDownload(function () use($pdf) {
				echo $pdf->stream();
			}, 'boleta.pdf');
		} else { //if student were empty
			$this->showReportCard = false;
			$this->emit(
				"show-toast",
				"Boleta",
				"No se encontraron datos, con el criterio de busqueda",
				"danger"
			);
		}
	}
}
