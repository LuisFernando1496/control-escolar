<?php

namespace App\Http\Livewire\Student;

use App\Models\Grade;
use App\Models\Group;
use App\Models\Report;
use App\Models\School;
use App\Models\Score;
use App\Models\Student;
use App\Models\Subject;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class MainComponent extends Component
{
    use GenerateReportCard;
    use WithPagination;
    public $search = '';
    public $perPage = '5';
    public $grade;
    public $group;
    public $studentFullname = '';
    public Student $student;
    public $reason;
    public $editing = false;
    public $reporting = false;
    public $list = false;
    public $isTheEnd = false;
    public $password = '';
    public $grade_id;
    public $group_id;
    public $path;
    public $user_id;
    protected $queryString = [
        'search' => ['except'=>''],
        'perPage' => ['except'=>0],
    ];
    public $confirmDeletion = false;
    protected $rules=[
        'student.behaviour'=>'numeric|max:10',
        'student.banned'=>'boolean',
        'student.banned_time'=>'date',
        'student.strikes'=>'numeric|max:3',
        'student.paid'=>'boolean',
        'student.address'=>'string|max:255',
        'student.tutor_id'=>'numeric',
        'student.blood_id'=>'numeric',


    ];
    public function mount(){
        $this->student = Student::all()->first();
        $this->grade = 0;
        $this->group = 0;
        $this->isTheEnd= false;
    }
    public function render()
    {
        // seleccionar solo el añor pero sin repetirce - en generar pdf
        //para conoceer los ciclos y generar los pdfs
        //va optener los años de las que se han incritos a los horarios
        $this->periods = DB::table('schedule_student')->select(DB::raw('YEAR(created_at) AS period'))->distinct()->get();
        $totalStudents = Student::all()->count();
        $this->page = $totalStudents >= $this->perPage ? $this->page : 1;
        $t = $this;
        return view('livewire.student.main-component',[
            'students'=>Student::with(['user','records'])
            ->when($this->group!=0,function($query) use ($t){
                $query->where('current_group_id','like',$t->group);
            })->when($this->grade!=0, function($query) use ($t){
                $query->where('current_grade_id','like',$t->grade);
            })
            ->where('end',false)
            ->whereIn('user_id', function($query) use ($t){
                $query->select('id')
                ->from('users')
                ->orWhere('name','like', "%{$t->search}%")
                ->orWhere('email','like',"%{$t->search}%")
                ->orWhere('key','like',"%{$t->search}%")
                ->orderBy('name','desc');
            })->paginate($this->perPage)
        ]);
    }
    public function clear(){
        $this->search = '';
        $this->perPage = 5;
    }
    public function deleteConfirmationModal(Student $student){
        $this->student = $student;
        $this->studentFullname = $this->student->user->fullname();
        $this->confirmDeletion = true;
    }
    public function destroy(){
        $this->student->delete();
        $this->confirmDeletion = false;
        $this->emit("show-toast", "El Estudiante", "Se ha eliminado", "danger");
    }
    public function deleteCancel(){
        $this->confirmDeletion = false;
    }
    public function edit(Student $student){
        $this->student = $student;
        $this->editing = true;
    }
    public function update(){
        $this->validate([
            'student.behaviour'=>'numeric|max:10',
            'student.banned'=>'boolean',
            'student.banned_time'=>'date',
            'student.strikes'=>'numeric|max:3',
            'student.paid'=>'boolean',
            'student.address'=>'string|max:255',
            'student.tutor_id'=>'numeric',
            'student.blood_id'=>'numeric',
        ]);
        $this->student->save();
        $this->editing = false;
        $this->emit("show-toast", "El Estudiante", "Se ha guardado, con exito.", "success");
        return;
    }
    public function close(){
        $this->editing = false;
    }
    public function report(){
        $this->validate([
            'reason'=>'string|required'
        ]);
        Report::create([
            'reason'=>$this->reason,
            'user_id'=>auth()->user()->id,
            'student_id'=>$this->student->id,
        ]);
        $this->student->update(['strikes'=>($this->student->strikes+1)]);
        if($this->student->strikes < 3){
            $this->emit("show-toast", "El Estudiante", "Ha sido reportado, con exito.", "success");
        } else {
            $now =(new Carbon())->addDays(3)->toDateTimeString();
            $this->student->update(['strikes'=>0,'banned'=>true, 'banned_time'=>$now]);
            $this->emit("show-toast", "El Estudiante", "Ha sido reportado y Expulsado por acumular 3 reportes, con exito.", "success");
        }
        $this->reporting = false;
        $this->reason = '';
    }
    public function reportModal(Student $student){
        $this->reporting = true;
        $this->student= $student;
    }
    public function showListReports(Student $student){
        $this->student =  $student;
        $this->list = true;
    }
    /**
     * Metodo generador de cartas segun el comportamiento actual
     */
    public function letter(Student $student){
        $behaviour = "Buena";
        $reports = $student->reports?$student->reports->count():0;
        if($reports <= 1){
            $behaviour = "Buena";
        }
        if($reports >= 2 && $reports <= 3 ){
            $behaviour = "Regular";
        }
        if($reports >= 4 ){
            $behaviour = "Mala";
        }
        $now = Carbon::now();
        $pdf = PDF::loadView('documents.letter',[
            'school'=>School::all()->first(),
            'student'=>$student,
            'now'=> $now,
            'month'=>$this->translateMonth($now->format('m')),
            'behaviour'=>$behaviour
        ]);
        $saved = Storage::put("public/letters/".$student->user->key.".pdf",$pdf->output());
        if ($saved) {
            $path ="public/letters/{$student->user->key}.pdf";
            if (!$student->letter) {
                $student->letter()->create([
                    'signer_id'=> auth()->user()->id,
                    'behaviour'=>$behaviour,
                    'path'=>$path,
                ]);
            } else {
                $student->letter->update([
                    'signer_id'=> auth()->user()->id,
                    'behaviour'=>$behaviour,
                    'path'=>$path,
                ]);
            }
            $this->emit('show-toast','Carta de Conducta', 'Generada','success');
        } else {
            $this->emit('show-toast','Carta de Conducta', 'No se pudo Guardar','danger');
        }
    }
    /**
     * Metodo axuliar de traduccion de meses
     */
    private function translateMonth($n){
        $month = ['Enero','Febrero','Marzo','Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
        return $month[$n - 1];
    }
    /**
     * Metodo para finalizacion de ciclo escolar
     */
    public function theEnd(){
        // Subir de grado a todos una vez me confirma la contraseña
       if (strlen($this->password) >= 8 && Hash::check($this->password,auth()->user()->password)) {
            Student::where('end',false)->get()->each(function($student){
                // aprobar si cumple el critterio
                $failedCounter = 0;
                foreach(Subject::where('grade_id',$student->currentGrade->id)->get() as $subject){
                    if($student->subjectAverage($subject->id,$student->currentGrade->number) < 6)
                    {
                        $failedCounter++;
                    }
                }
                if ($student->yearAverage() >= 6 && $failedCounter < 4) {
                    // funcion interna de aprovacion
                    $student->upgrade();
                } else {
                    $student->user->update(['active'=>false]);
                }
            });
            $this->isTheEnd = false;
            $this->emit('show-toast','Estudiantes.','El ciclo terminó, los estudiantes con promedio MAYOR A 6 han sido APROBADOS y los estudiantes con 4 MATERIAS REPROBADAS han sido DESHABILITADOS','success');
       }
    }
     /**
      * Funcion generadora de listas de alumnos requiere el grado y grupo
     */
    public function list() {
        if($this->grade_id && $this->group_id){
            $grade = Grade::find($this->grade_id);
            $group = Group::find($this->group_id);
            $user = User::find($this->user_id);
            $filename = "Lista de alumnos - {$grade->number} {$group->name}.pdf";
            $date = Carbon::now();
            $pdf = PDF::loadview('documents.list',[
                'students'=>Student::with(['user'])->where([
                    ['current_grade_id','=',$this->grade_id],
                    ['current_group_id','=',$this->group_id]
                ])->whereIn('user_id',function($query){
                    $query->select('id')
                    ->from('users')->orderBy('lastname1');
                })->get(),
                'school'=>School::all()->first(),
                'grade'=>$grade,
                'group'=>$group,
                'date'=>$date,
                'user'=>$user,
                'month'=>$this->translateMonth($date->format('m'))
            ])->setPaper('a4', 'landscape');
            $saved = Storage::put("public/lists/{$filename}",$pdf->output());
            if ($saved) {
                $this->path ="public/lists/{$filename}";
                $this->emit('show-toast','Estudiantes.', 'Lista Generada','success');
            } else {
                $this->emit('show-toast','Estudiantes.', 'No se pudo generar la lista','danger');
            }
        } else {
            $this->emit('show-toast','Estudiantes.','Seleccione al Asesor, Grado y Grupo','danger');
        }
    }
    /**
     * este metodo se encarga de generar la boleta
     * solo cuando se ha completado:
     * primer añor
     * 6 bimestres
     * 12 bimestres
     * 18 bimestres
     *
     * @return
     */
    public function reportCardYearOne(){

    }
}
