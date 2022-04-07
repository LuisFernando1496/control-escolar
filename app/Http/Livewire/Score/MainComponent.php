<?php

namespace App\Http\Livewire\Score;

use App\Models\Bimester;
use App\Models\Grade;
use App\Models\School;
use App\Models\Score;
use App\Models\Student;
use App\Models\Subject;
use Livewire\Component;
use App\Models\Tutors;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use Subjects;

class MainComponent extends Component
{
    public ?Student $student_;
    public ?Tutors $tutor_;
    public $group_id;
    public $grade_id;
    public $bimester_id;
    public $scoreRow = [];
    public $isStudent = false;
    public $isTutor = false;
    public $kardexMode = false;
    public $schedule = [[], []];
    public function mount(){
        $this->isStudent = auth()->user()->findRole('alumno');
        $this->isTutor = auth()->user()->findRole('tutor');//modificacion para tutor
        if($this->isStudent){
            $student = auth()->user()->student;
            $this->student_ = $student;
            $this->grade_id = $student->currentGrade->id;
            $this->group_id = $student->currentGroup->id;
        }
        if($this->isTutor){//mofificacion para el tutor y calificaciones
            $user =   Student::where('tutor_id', auth()->user()->id)->first();
            $student = $user->user->student;
           
            $this->student_ = $student;
         
            $this->grade_id = $student->currentGrade->id;
            $this->group_id = $student->currentGroup->id;
        }
    }
    public function render()
    {
        $data = [];
        if($this->isStudent){
            $data= [
                'students'=>Student::where([
                    ['id','=', auth()->user()->student->id]
                ])->paginate(30),
                'subjects'=>Subject::where([['grade_id',$this->grade_id],['key','!=','receso']])->orderBy('name')->get()
            ];
        }
        if($this->isTutor){
            $user =   Student::where('tutor_id', auth()->user()->id)->first();
            $data = [
                'students'=>Student::where([
                    ['id','=', $user->user->student->id]
                ])->paginate(30),
                'subjects'=>Subject::where([['grade_id',$this->grade_id],['key','!=','receso']])->orderBy('name')->get(),
            ];
        }
        else{
            $data = [
                'students'=>Student::where([
                    ['end',false]
                ])->whereIn('id', function($query){
                    $query->from('records')
                    ->select('student_id')
                    ->where([
                        'grade_id'=> $this->grade_id,
                        'group_id'=> $this->group_id,
                    ]);
                })->paginate(30),
                'subjects'=>Subject::where([['grade_id',$this->grade_id],['key','!=','receso']])->orderBy('name')->get()
            ];
        }
        return view('livewire.score.main-component',$data);
    }
    public function save(Student $student){
        $wrong =  array_filter(
            $this->scoreRow,
            function ($value) {
                return $value >10 || $value < 0;
            }
        );
        if(count($wrong)>0){
            $this->emit('show-toast','Calificaciones.','Las calificaciones no pueden ser mayores a 10 y menores que 0','danger');
            $this->student_ = null;
            $this->tutor_ = null;
        }else{
            foreach($this->scoreRow as $key=> $scoreCaptured){
                $subject_id = str_replace('s','',$key);
                $scoreMatch = Score::where([
                    ['student_id','=',$student->id],
                    ['subject_id','=',$subject_id],
                    ['bimester_id','=', $this->bimester_id]
                ])->first();
                if ($scoreMatch) {
                    $scoreMatch->update([
                        'score'=>$scoreCaptured,
                        'approved'=>$scoreCaptured > 5
                    ]);
                } else{
                    Score::create([
                        "score" => $scoreCaptured,
                        "approved" => $scoreCaptured > 5,
                        "student_id" => $student->id,
                        "bimester_id"=> $this->bimester_id,
                        'subject_id'=>$subject_id
                    ]);
                }
            }
            $this->scoreRow = [];
            $this->student_ = null;
            $this->tutor_ = null;
            $this->emit('show-toast','Calificaciones.','Capturadas para el estudiente: '.$student->user->fullname(),'success');
        }

    }
    public function toggle(){
       $this->kardexMode = !$this->kardexMode;;
    }
    public function dscargarPdfScore()
    {
        $school = School::first();
		$schedules = $this->schedule;
        $date = Carbon::now();
        
        
        if($this->isStudent){
         $user =   Student::where('user_id', auth()->user()->id)->first();
         $data= [
            'students'=>Student::where([
                ['id','=', auth()->user()->student->id]
            ])->paginate(30),
            'subjects'=>Subject::where([['grade_id',$this->grade_id],['key','!=','receso']])->orderBy('name')->get(),
        ];
           
        }
        if($this->isTutor){
            $user =   Student::where('tutor_id', auth()->user()->id)->first();
            $data = [
                'students'=>Student::where([
                    ['id','=', $user->user->student->id]
                ])->paginate(30),
                'subjects'=>Subject::where([['grade_id',$this->grade_id],['key','!=','receso']])->orderBy('name')->get(),
            ];
        }
        $user = $user->tutor;
        $bimestres = Bimester::all();
        $grade_id= $this->grade_id;
        $isStudent = $this->isStudent;
        $student = $this->student_ ;
        $nombreStudent =$student->user->fullname();
        $pdf = PDF::loadView(
            "documents.calificaciones",
            compact("schedules", "school", "date","bimestres","grade_id","isStudent","student","user"),$data
        )->setPaper('a4', 'landscape');
        return response()->streamDownload(function () use($pdf) {
            echo $pdf->stream();
        }, "Calificaciones-$nombreStudent-$date.pdf");
    }
    public function setStudent(Student $student){
        $this->student_ = $student;
    }
    public function setnull(){
        $this->student_ = null;
        $this->isTutor = null;
        $this->scoreRow = [];
    }
}
