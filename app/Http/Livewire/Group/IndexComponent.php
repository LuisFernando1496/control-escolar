<?php

namespace App\Http\Livewire\Group;

use Livewire\Component;

use App\Models\Group;

class IndexComponent extends Component
{
	public function render()
	{
		$groups = Group::all();
		return view("livewire.group.index-component", ["groups" => $groups]);
	}
}
