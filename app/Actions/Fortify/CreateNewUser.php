<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    ///NO USARRRRRRRRRRRRRRRRRRRRRR *****
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'lastname1'=>['required','string', 'max:255'],
            'lastname2'=>['required', 'string', 'max:255'],
            'rfc'=>['string','min:13','max:13','nullable'],
            'key'=>['required','unique:users','string', 'max:8'],
            'phone'=>['required','min:10','numeric','unique:users'],
            'sex'=>['required','boolean'],
            'birthday'=>['required','date'],
            'active'=>['required','boolean'],
            'roles'=>['required','array'],
            'isStudent'=>['boolean'],
            'paid'=>['boolean',Rule::requiredIf($input['isStudent'])],
            'address'=>['string',Rule::requiredIf($input['isStudent'])],
            'tutor'=>['string',Rule::requiredIf($input['isStudent'])],
            'blood_id'=> ['numeric',Rule::requiredIf($input['isStudent'])],
            'grade_id'=>['numeric', Rule::requiredIf($input['isStudent'])],
            'group_id'=>['numeric', Rule::requiredIf($input['isStudent'])]
        ])->validate();
        $user = User::create([
            'name' =>strtolower($input['name']),
            'lastname1' => strtolower($input['lastname1']),
            'lastname2' =>strtolower($input['lastname2']),
            'rfc' =>strtoupper($input['rfc']),
            'key' => $input['key'],
            'phone' => $input['phone'],
            'sex' => $input['sex'],
            'birthday' => $input['birthday'],
            'active' => $input['active'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);
        $user->roles()->attach($input['roles']);
        if($input['isStudent']){
            $date = Carbon::now();
            $user->student()->create([
                'behaviour' => 10,
                'banned' => false,
                'end' => false,
                'banned_time' => NULL,
                'strikes' => 0,
                'period'=>$date->format('Y-m-d'),
                'paid' =>$input['paid'],
                'address' => $input['address'],
                'tutor' => $input['tutor'],
                'blood_id' => $input['blood_id'],
                'current_group_id' => $input['group_id'],
                'current_grade_id' => $input['grade_id'],
            ]);
            $user->student->records()->create([
                'grade_id'=>$input['grade_id'],
                'group_id'=>$input['group_id'],
                'score'=>-1
            ]);
            if(!$input['paid']){
                $user->update(['active'=>false]);
            }
        }
        return $user;
    }
}
