<?php

namespace App\Http\Livewire\Shared;

use Livewire\Component;

class ToastNotification extends Component
{
	protected $listeners = ["show-toast" => "setToast"];
	public $alertTypeClasses = [
		"success" => "bg-green-200 border-l-8 border-green-500 text-green-900",
		"info" => "bg-blue-100 border-l-8 border-blue-500 text-blue-900",
		"warning" => "bg-yellow-50 border-l-8 border-yellow-300 text-yellow-900",
		"danger" => "bg-red-100 border-l-8 border-red-500 text-red-900",
	];
	public $title = "title";
	public $message = "Notification Message";
	public $alertType = "warning";

	public function setToast($title, $message, $alertType)
	{
		$this->title = $title;
		$this->message = $message;
		$this->alertType = $alertType;

		$this->dispatchBrowserEvent("toast-message-show");
	}

	public function render()
	{
		return view("livewire.shared.toast");
	}
}
