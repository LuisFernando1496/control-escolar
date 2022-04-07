<?php

namespace App\Http\Livewire\Subject;

use Livewire\Component;
use App\Models\Subject;

use Illuminate\Http\Request;
use Livewire\WithPagination;

class MainComponent extends Component
{
    use WithPagination;
	//tile for the modal  when going to create or update
	public $title;
	// fomulario reactivo
	public ?Subject $materia;
	public $clave, $idMateria;
	// modal interaction
	public $modalVisible = false;
	public $keySubject = false;
	public $confirmDeletion = false; //reusable
	public $deleteName = '';

	protected $rules = [
		'materia.name' => 'required',
		'materia.key' => 'required',
		'materia.grade_id' => 'required',
	];
	public function render()
	{
		$subjects = Subject::paginate();
		return view("livewire.subject.main-component", [
			"subjects" => $subjects,
		]);
	}

	public function store()
	{
		$this->validate();
		$this->materia->save();
		$this->modalVisible = false;
		$this->emit("show-toast", "La materia", "Se ha guardado, con exito.", "success");
	}

	//buttons events
	/**
	 * show the form modal
	 * of the create function
	 *
	 * @return void
	 */
	public function createShowModal()
	{
		$this->cleanForm();
		$this->keySubject = true;
		$this->title = "new";
		$this->modalVisible = true;
		
	}
	/**
	 * Get the actual
	 * subject
	 * bad practice
	 * fix later
	 *
	 * @param Subject $subject
	 * @return void
	 */
	public function editShowModal(Subject $subject)
	{
		$this->title = "edit";
		$this->keySubject = false;
		$this->modalVisible = true;
		$this->materia = $subject;
	}
	/**
	 * Update function
	 * when modal is open
	 * @param Subject $subject
	 * @return void
	 */
	public function update(Subject $subject)
	{
		$this->materia->except('key');
		$this->materia->update();
		$this->modalVisible = false;
		$this->cleanForm();
	}

	//delete subject part

	public function deleteConfirmationModal(Subject $subject)
	{
		$this->confirmDeletion = true;
		$this->deleteName = $subject->name;
		$this->materia = $subject;
	}
public function destroy()
{
	$this->materia->delete();
	$this->cleanForm();
	$this->confirmDeletion = false;
}

	/**
	 * Clean the form
	 * of the modal create or update
	 *
	 * @return void
	 */
	public function cleanForm()
	{
		$this->materia = new Subject;
	}
}
