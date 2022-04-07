<?php

namespace App\Http\Livewire\Report;

use App\Models\Report;
use Livewire\Component;

class MainComponent extends Component
{
    public $report;
    public $currentTarget;
    public $idReport;
    public $confirmDeletion = false; //reusable
    public function render()
    {
        return view('livewire.report.main-component',[
            'reports'=>Report::orderBy('created_at','desc')->paginate()
        ]);
    }
    public function deleteConfirmationModal(Report $report){
        $this->currentTarget = $report;
        $this->confirmDeletion = true;
		$this->report = "Desea eliminar el reporte de {$report->student->user->fullname()} - {$report->reason} - por {$report->user->fullname()}";
		$this->idReport = $report->id;
    }
    public function destroy(){
        $this->currentTarget->delete();
        $this->currentTarget->student->update(['strikes'=>$this->currentTarget->student->strikes - 1]);
        $this->confirmDeletion = false;
        $this->emit("show-toast", "El Reporte", "Ha sido eliminado y restado del estudiante.", "warning");
    }
}
