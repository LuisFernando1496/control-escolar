<?php

namespace App\Http\Livewire\Asset;

use Livewire\Component;

use App\Models\Asset;
use App\Models\Subject;

use Livewire\WithFileUploads;

class MainComponent extends Component
{
	use WithFileUploads;
	//variable to create or edit
	public $assets;

	//busqueda
	public $ages, $subjects;
	public $age = 0,
		$subject = 0;
	//modal variables
	public $showModal = false;
	//variable que almacena un file
	public $document;
	public $asset;
	public $view = "new"; //checking mode edit or create
	//delete confirmation modal
	public $confirmDeletion = false;
	public $curretAsset;
	public $toDelete = "";

	protected $rules = [
		"asset.title" => "required",
		"asset.description" => "required",
		"asset.subject_id" => "required",
		"document" => "required|max:50000", // 50MB Max
	];

	protected $messages = [
		"asset.subject_id.required" =>
			"Debe de elegir a la materia que va dirigido.",
		"asset.title.required" => "El campo titulo es obligatorio.",
		"asset.description.required" => "El campo descripcion es obligatorio.",
	];

	public function render()
	{
		$this->subjects = Subject::all();
		$t = $this;
		$this->assets = Asset::with("teacher", "subject")
			->when($t->subject == 0, function ($subject) use ($t) {
				$subject->where("subject_id", ">", 0);
			})
			->when($t->subject != 0, function ($subject) use ($t) {
				$subject->where("subject_id", "=", $t->subject);
			})
			->get()
			->filter(function ($asset) use ($t) {
				if ($t->age != 0) {
					return $asset->subject->grade_id == $t->age;
				} else {
					return $asset;
				}
			});
		return view("livewire.asset.main-component", [
			"assets" => $this->assets,
		]);
	}

	//bloc create or save

	/**
	 * se abre el modal
	 * para mostrar el formulario de creacion
	 * @return void
	 */
	public function modalNew()
	{
		$this->clean();
		$this->view = "new";
		$this->showModal = true;
	}

	public function store()
	{
		$this->reactiveValidation();
		$path = $this->storeFile();

		Asset::create(
			$this->asset + ["path" => $path, "teacher_id" => \Auth::user()->id]
		);
		$this->showModal = false;
		$this->clean();
	}

	public function showEdit(Asset $asset)
	{
		$this->clean();
		$this->asset = $asset;
		$this->view = "edit";
		$this->showModal = true;
	}

	public function update()
	{
		$this->reactiveValidation();
		if (isset($this->document)) {
			$this->removeFile($this->asset->path);
			$this->asset->path = $this->storeFile();
		}

		$this->asset->update();
		$this->showModal = false;
		$this->clean();
	}

	//delet actions
	public function deleteConfirmationModal(Asset $asset)
	{
		$this->curretAsset = $asset;
		$this->toDelete = $asset->title;
		$this->confirmDeletion = true;
	}
	public function destroy()
	{
		$this->curretAsset->delete();
		$this->removeFile($this->curretAsset->path);
		$this->confirmDeletion = false;
		$this->emit(
			"show-toast",
			"La instrumentacion",
			"Ha sido eliminado",
			"success"
		);
		$this->clean();
	}
	//store and update files adove

	public function storeFile()
	{
		$materia = Subject::where("id", $this->asset["subject_id"])->first();
		$rute =
			"public/instrumentacion/" .
			$materia->grade->description .
			"/" .
			$materia->name .
			"/";
		$title = $this->asset["title"] . "." . $this->document->extension();
		$this->document->storeAs($rute, $title);

		//update
		return $materia->grade->description . "/" . $materia->name . "/" . $title;
	}

	public function removeFile($filename)
	{
		$path = storage_path("app/public/instrumentacion/" . $filename);
		if (file_exists($path)) {
			unlink($path); //delete from strange
		}
	}

	public function reactiveValidation()
	{
		$document = $this->document;
		$this->validate([
			"asset.title" => "required",
			"asset.description" => "required",
			"asset.subject_id" => "required",
			"document" => [
				function ($attribute, $value, $fail) use ($document) {
					if (!empty($document)) {
						$extencion = $document->extension();
						$typeFilesPermited = [
							"jpeg",
							"png",
							"jpg",
							"JPG",
							"webp",
							"docx",
							"pdf",
						];
						$exist = in_array($extencion, $typeFilesPermited);
						if (!$exist) {
							$fail(
								'Tipo de archivo no permitido solo se permite: "jpeg", "png", "jpg", "JPG", "webp", "docx", "pdf"'
							);
						}
					} else {
						$fail("Eliga un archivo, para el Aviso/convocatoria");
					}
				},
			],
		]);
	}

	public function clean()
	{
		$this->asset = null;
		$this->document = null;
		$this->toDelete = "";
		$this->resetValidation();
	}
}
