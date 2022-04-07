<?php

namespace App\Http\Controllers;

use App\Actions\Fortify\PasswordValidationRules;
use App\Models\User;
use App\Models\Role;
use App\Models\Schedule;
use Carbon\Carbon;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class StudentController extends Controller
{
    use PasswordValidationRules;

    public function create(){
        $tutors = Role::with('users')->whereId(4)->get();
      // $user = Student::where('tutor_id',12)->first();
     // return  $user->user->id;
        return view('auth.register',compact('tutors'));
    }
    public function store(Request $request)
    {
        $boleano=$request->isStudent;
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'lastname1'=>['required','string', 'max:255'],
            'lastname2'=>['required', 'string', 'max:255'],
            'rfc'=>['string','min:13','max:13','nullable'],
            'key'=>['required','string', 'max:8'],
            'phone'=>['required','min:10','numeric','unique:users'],
            'sex'=>['required','boolean'],
            'birthday'=>['required','date'],
            'active'=>['required','boolean'],
            'roles'=>['required','array'],
            'isStudent'=>['boolean'],
            'isTutor'=>['boolean'],
            
        ]);
      
       $user = User::create([
            'name' =>strtolower($request['name']),
            'lastname1' => strtolower($request['lastname1']),
            'lastname2' =>strtolower($request['lastname2']),
            'rfc' =>strtoupper($request['rfc']),
            'key' => $request['key'],
            'phone' => $request['phone'],
            'sex' => $request['sex'],
            'birthday' => $request['birthday'],
            'active' => $request['active'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);
        $user->roles()->attach($request['roles']);
        if($request['isStudent']){
            $date = Carbon::now();
            $user->student()->create([
                'behaviour' => 10,
                'banned' => false,
                'end' => false,
                'banned_time' => NULL,
                'period'=>$date->format('Y-m-d'),
                'strikes' => 0,
                'paid' =>$request['paid'],
                'address' => $request['address'],
                'tutor_id' => $request['tutor'],
                'blood_id' => $request['blood_id'],
                'current_group_id' => $request['group_id'],
                'current_grade_id' => $request['grade_id'],
            ]);
            $user->student->records()->create([ 
                'grade_id'=>$request['grade_id'],
                'group_id'=>$request['group_id'],
                'score'=>-1
            ]);
            if(!$request['paid']){
                $user->update(['active'=>false]);
            }
            $horario = Schedule::where('grade_id',$request['grade_id'])
            ->where('group_id',$request['group_id'])->get();
           foreach($horario as $itemHorario){
                 $user->student->schedules()->attach($itemHorario->id);
            }
           
					
				
        }
        if($request['isTutor']){
            $user->tutor()->create([
                'direccion' => $request['direccion']
            ]);
            }
        return redirect()->route('students');
    }//return $request->all();}
}
