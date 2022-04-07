<?php

namespace App\Http\Livewire\Notices\Admin;

use Livewire\Component;
use App\Models\Notice;

//for upload files
use File;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

use function PHPSTORM_META\type;

class IndexComponent extends Component
{
	use WithFileUploads;
	//forms modal  variable
	public $modalVisible = false;
	public $title, $view;

	//object de la convocatorio/aviso
	public Notice $notice; // me retornava un error asi que no puede poner el Model |$notice must not be accessed before initialization
	public $noticeFile;

	//reusable component delete confirmation modal
	public $confirmDeletion = false;
	public $noticeToDelete = "";

	protected $rules = [
		"notice.title" => "required|string|min:6",
		"notice.body" => "required|string|max:500",
		"noticeFile" => "required|max:50000", // 50MB Max
		// "notice.type" => "required",
		// "notice.file" => "required",
		// "notice.uuid" => "required",
		// "notice.user_id" => "required",
	];

	public function mount()
	{
		$this->notice = new Notice();
	}
	public function render()
	{
		$notices = Notice::orderBy("created_at", "DESC")->paginate(8);
		return view("livewire.notices.admin.table-component", [
			"notices" => $notices,
		]);
	}

	//create functions
	public function newNotice()
	{
		$this->cleanForm();
		$this->modalVisible = true;
		$this->view = "new";
		$this->title = "Registro de nueva noticia";
	}
	public function store()
	{
		$this->reactiveValidation();
		$this->notice->uuid = (string) Str::orderedUuid();
		$file = $this->storeFile();
		$this->notice->save();
		$this->emit("show-toast", "Un aviso", "Ha sido creado.", "success");
		$this->modalVisible = false;
		$this->cleanForm();
	}

	//destroy fuction
	public function destroyModal($uuid)
	{
		$this->notice = Notice::where("id", $uuid)->first();
		$this->noticeToDelete = $this->notice->title;

		$this->confirmDeletion = true;
	}
	public function destroy()
	{
		$this->notice->delete();
		$this->removeFile($this->notice->file);
		$this->emit("show-toast", "Un aviso", "Ha sido eliminado.", "warning");
		$this->confirmDeletion = false;
		$this->modalVisible = false;
		$this->cleanForm();
	}

	//update functions()
	public function update()
	{
		$this->reactiveValidation();
		if (isset($this->noticeFile)) {
			$this->removeFile($this->notice->file);
			$file = $this->storeFile();
			$this->notice->update();
			$this->emit("show-toast", "Un aviso", "Ha sido actualizado.", "success");
			$this->cleanForm();
			$this->modalVisible = false;
		}
	}
	public function editShowModal($uuid)
	{
		$this->cleanForm();
		$this->notice = Notice::where("id", $uuid)->first();
		$this->view = "edit";
		$this->modalVisible = true;
	}

	public function storeFile()
	{
		// $this->validate([
		// 	"noticeFile" => "required|max:50000", // 50MB Max
		// ]);
		$type_file = $this->noticeFile->extension();
		$nameFile = $this->notice->uuid . "." . $type_file;
		$this->noticeFile->storeAs("public/convocatorias", $nameFile);

		$type = "";
		$images = ["jpeg", "png", "jpg", "JPG", "webp", "mp4"];
		foreach ($images as $image) {
			if ($image == $type_file) {
				$type = "image";
			} elseif ($type_file == "pdf") {
				$type = "pdf";
			} elseif ($type_file == "docx") {
				$type = "document";
			} elseif ($type_file == "mp4") {
				$type = "video";
			}
		}
		$this->notice->type = $type;
		$this->notice->file = $nameFile;
		$this->notice->user_id = \Auth::user()->id;
	}

	public function removeFile($file)
	{
		$path = storage_path("app/public/convocatorias/" . $file);

		if (file_exists($path)) {
			unlink($path); //delete from strange
		}
	}

	public function reactiveValidation()
	{
		$notice = $this->noticeFile;
		$this->validate([
			"notice.title" => "required|string|min:6",
			"notice.body" => "required|string|max:500",
			"noticeFile" => [
				function ($attribute, $value, $fail) use ($notice) {
					if (!empty($notice)) {
						$extencion = $notice->extension();
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
								'Tipo de archivo no permitido solo se permite: "jpeg", "png", "jpg", "JPG", "webp", "docx", "pdf'
							);
						}
					} else {
						$fail("Eliga un archivo, para la convocatoria");
					}
				},
			],
		]);
	}
	public function cleanForm()
	{
		$this->notice = new Notice();
		$this->noticeFile = null;
		$this->resetValidation();
	}
}
