<?php

namespace App\Http\Livewire\Letter;

use App\Models\Letter;
use App\Models\Student;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class MainComponent extends Component
{
    public $confirmDeletion = false;
    public $preview = false;
    public ?Letter $letter;
    public $search = '';
    public function render()
    {
        $t = $this;
        return view('livewire.letter.main-component',[
            'searchBar'=>true,
            'pages'=>true,
            'letters'=>Letter::whereIn('student_id',function($query) use ($t){
                $query->select('id')
                ->from('students')
                ->whereIn('user_id',function($query) use ($t){
                    $query->select('id')
                    ->from('users')
                    ->where('key','like',"%{$t->search}%");
                });
            })->paginate(),
            'props'=>[],
            'headers'=>['Alumno','Conducta','Documento','Responsable'],
            'actions'=>[
                ['method'=>'deleteConfirmationModal','display'=>'Eliminar','bg'=>'red','font'=>'red']
            ]
        ]);
    }
    public function show(Letter $letter){
        $this->letter = $letter;
        $this->preview = true;
    }
    public function deleteConfirmationModal(Letter $letter){
        $this->confirmDeletion = true;
        $this->letter = $letter;
    }
    public function destroy(){
        if (Storage::exists($this->letter->path)) {
            $deleted = Storage::delete($this->letter->path);
            if ($deleted) {
                $this->letter->delete();
                $this->emit('show-toast','Carta de Conducta','Se ha eliminado','danger');
            }else{
                $this->emit('show-toast','Carta de Conducta','Error al eliminar','warning');
            }
        } else{
            $this->letter->delete();
            $this->emit('show-toast','Carta de Conducta','Se ha eliminado (Archivo inexistente)','danger');
        }
        $this->confirmDeletion = false;
    }
    public function clear(){
        $this->search = '';
    }
}
