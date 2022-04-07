<?php

namespace App\Http\Livewire\Notices;

use Livewire\Component;
use App\Models\Notice;

class Feed extends Component
{
    public function render()
    {
        $notices = Notice::orderBy("created_at", "desc")->get();
        return view('livewire.notices.feed.index', [
            "notices" => $notices
        ]);
    }
}
