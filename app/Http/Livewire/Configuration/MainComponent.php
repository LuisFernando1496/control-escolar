<?php

namespace App\Http\Livewire\Configuration;

use App\Models\School;
use App\Models\Stage;
use App\Models\Student;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class MainComponent extends Component
{
    use WithFileUploads;
    public ?School $school;
    public ?Stage $stage;
    public $editing = false;
    public $logo;
    protected $rules = [
        'school.name'=>'string|max:255',
        'school.boss'=>'string|max:255',
        'school.email'=>'string|max:255',
        'school.phone'=>'numeric|max:9999999999',
        'school.address'=>'string',
        'stage.deadline'=>'date'
    ];
    public function mount(){
        $this->school = School::all()->first();
        $this->stage = Stage::where('active',true)->first();
    }
    public function render()
    {
        return view('livewire.configuration.main-component',[
            'total'=>Student::whereIn('user_id',function($query){
                $query->select('id')
                ->from('users')
                ->where('active','=', true)->get();
            })->count(),
        ]);
    }
    public function change(){
        if($this->stage)
        {
            $newStage = Stage::where('active',false)->first();
            $this->stage->update(['active'=>false]);
            $newStage->update(['active'=>true]);
            $this->stage = $newStage;
            $this->emit("show-toast","El Periodo", "Ha sido cambiado.", "success");
        }
    }
    public function setStage($on){
        if ($on) {
            $this->stage = Stage::where([
                ['active','=',false],
                ['slug','=','regist'],
            ])->first();
            $this->stage->update(['active'=>true]);
            $this->emit("show-toast","Los Periodos", "Ha sido activados.", "success");
        }else {
            Stage::where([
                ['active','=',true],
            ])->each(function($stage){$stage->update(['active'=>false]);});
            $this->stage=null;
            $this->emit("show-toast","Los Periodos", "Ha sido desactivados.", "danger");
        }
    }
    public function edit(School $school){
        $this->school = $school;
        $this->editing = true;
    }
    public function update(){
        $this->validate();
        $this->school->save();
        $this->editing = false;
    }
    public function updateLogo(){
        $this->validate([
            'logo' => 'image|required'
        ]);
        Storage::delete($this->school->logo);
        $path = $this->logo->store('public/images');
        $this->school->update(['logo'=>$path]);
        $this->emit('show-toast','La Imagen','Ha sido actualizada','success');
    }
    public function changeDeadline(){
        $this->stage->save();
    }
}
