<?php

namespace App\Http\Livewire\History;

use App\Models\Record;
use Livewire\Component;
use App\Models\Student;
class MainComponent extends Component
{
    public Record $record;
    public $confirmDeletion = false;
    public $editing = false;
    public $search = '';
    public $isStudent = false;
    public $isTutor = false;//historial academico para el tutor
    protected $rules = [
        'record.student_id'=>'numeric',
        'record.group_id'=>'numeric',
        'record.grade_id'=>'numeric',
        'record.score'=>'numeric|max:10|min:-1'
    ];
    public function mount(){
        $this->isStudent = auth()->user()->findRole('alumno');
        $this->isTutor = auth()->user()->findRole('tutor');//historial academico para el tutor
    }
    public function render()
    {
        $t = $this;
        $query = null;
        if($this->isTutor) //historial academico para el tutor
        {
            $query = Record::with(['student','group','grade'])
            ->whereIn('student_id', function($query) use ($t){
                $query
                ->select('id')
                ->from('students')
                ->whereIn('user_id', function($query) use($t) {
                    $student = Student::where('tutor_id', auth()->user()->id)->first();
                    $query
                    ->select('id')
                    ->from('users')
                    ->where('id',$student->user->id)->orderBy('name');
                });
            })
            ->orderBy('student_id','desc')->paginate();
        }
        elseif ($this->isStudent) {
            
            $query = Record::with(['student','group','grade'])
            ->whereIn('student_id', function($query) use ($t){
                $query
                ->select('id')
                ->from('students')
                ->whereIn('user_id', function($query) use($t) {
                    $query
                    ->select('id')
                    ->from('users')
                    ->where('id',auth()->user()->id)->orderBy('name');
                });
            })
            ->orderBy('student_id','desc')->paginate();
        } 
     
        else {
            $query = Record::with(['student','group','grade'])
                ->whereIn('student_id', function($query) use ($t){
                    $query
                    ->select('id')
                    ->from('students')
                    ->whereIn('user_id', function($query) use($t) {
                        $query
                        ->select('id')
                        ->from('users')
                        ->where('key','like',"%$t->search%")->orderBy('name');
                    });
                })
                ->orderBy('student_id','desc')->paginate();
        }
        return view('livewire.history.main-component',[
            'pages'=>true,
            'records'=>$query,
            'props'=>[],
            'headers'=>['Alumno','Grado','Grupo','Calificación Final'],
            'actions'=>[
                ['method'=>'deleteConfirmationModal','display'=>'Eliminar','bg'=>'red','font'=>'red'],
                ['method'=>'editModal','display'=>'Editar','bg'=>'blue','font'=>'blue']
            ]
        ]);
    }
    public function deleteConfirmationModal(Record $record){
        $this->record = $record;
        $this->confirmDeletion = true;
    }
    public function editModal(Record $record){
        $this->editing = true;
        $this->record = $record;
    }
    public function update(){
        $this->validate();
        $this->record->save();
        $this->editing=false;
    }
    public function destroy(){
        $this->record->delete();
        $this->confirmDeletion = false;
        $this->emit('show-toast','Historiales',' El Historial del alumno se elimino','danger');
    }
    public function clear(){
        $this->search = '';
    }
}
