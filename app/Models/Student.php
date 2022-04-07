<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{

    use HasFactory;
    protected $with = ['blood'];
    protected $fillable = ['behaviour','banned','banned_time','strikes','paid','address','tutor_id','blood_id','user_id','end','period','current_grade_id','current_group_id'];

    public function blood()
    {
        return $this->belongsTo(Blood::class);
    }
    public function letter()
    {
        return $this->hasOne(Letter::class);
    }
    public function records()
    {
        return $this->hasMany(Record::class);
    }
    public function reports(){
        return $this->hasMany(Report::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function tutor(){
        return $this->belongsTo(User::class);
    }
    public function scores(){
        return $this->hasMany(Score::class);
    }
    public function schedules()
    {
        return $this->belongsToMany(Schedule::class)->withTimestamps();; //'role_user_table', 'user_id', 'role_id'
    }
    public function subjectAverage($subjectId, $gradeNumber){
        return round(Score::where([
            ['subject_id',$subjectId],
            ['student_id',$this->id],
            ['bimester_id','<=',$gradeNumber * 6], //maximo
            ['bimester_id','>',($gradeNumber - 1) * 6] //minimo
        ])->avg('score'),2);
    }
    public function average(){
        return round(Score::where('student_id','=', $this->id)->avg('score'),2);
    }
    public function yearAverage(){
        return round(Score::where([
            ['student_id','=',$this->id],
            ['bimester_id','<=',$this->currentGrade->number * 6], //maximo
            ['bimester_id','>',($this->currentGrade->number - 1) * 6] //minimo
        ])->avg('score'),2);
    }
    public function yearAverageBy($grade){
        return round(Score::where([
            ['student_id','=',$this->id],
            ['bimester_id','<=',$grade * 6], //maximo
            ['bimester_id','>',($grade - 1) * 6] //minimo
        ])->avg('score'),2);
    }
    public function bimesterAverage($bimesterId){
        return round(Score::where([
            ['student_id','=',$this->id],
            ['bimester_id','=',$bimesterId],
        ])->avg('score'),2);
    }
    public function lastBimester()
    {
        //despues del where regresa una collection | se utiliza un metodo de collection called last()
        return $this->scores->where('student_id', $this->id)->last()->bimester_id;
    }
    public function currentGrade(){
        return $this->belongsTo(Grade::class,'current_grade_id','id');
    }
    public function currentGroup(){
        return $this->belongsTo(Group::class,'current_group_id','id');
    }
    public function scoreBySubject($subjectId, $bimesterId){
        return Score::where([
            ['subject_id','=',$subjectId],
            ['student_id','=',$this->id],
            ['bimester_id','=',$bimesterId]
        ])->first();
    }
    public function upgrade(){
        if(!$this->end){
            switch($this->current_grade_id){
                case 1:
                    $this->records->first()->update(['score'=>$this->yearAverage()]);
                    $this->update(['current_grade_id' => 2]);
                    return 1;
                    break;
                case 2:
                    $this->records()->create([
                        'grade_id'=>2,
                        'group_id'=>$this->currentGroup->id,
                        'score'=>$this->yearAverage(),
                    ]);
                    $this->update(['current_grade_id' => 3]);
                    return 2;
                    break;
                case 3:
                    $this->records()->create([
                        'grade_id'=>3,
                        'group_id'=>$this->currentGroup->id,
                        'score'=>$this->yearAverage(),
                    ]);
                    $this->update(['end' => true]);
                    return 3;
                    break;
                default:
                    return -1;
            }
        } else {
            return 0;
        }
    }

        /**
         * Scope to find student  authenticate
         * with their current group and grade
         *
         *  @param  \Illuminate\Database\Eloquent\Builder  $query
         *  @return \Illuminate\Database\Eloquent\Builde
         */
        public function scopeCurrentStudent($query)
        {
            return $query->where([
                ['id',  \Auth::User()->student->id],
                ['current_group_id', \Auth::User()->student->current_group_id],
                ['current_grade_id', \Auth::User()->student->current_grade_id]
            ]);
        }
}
