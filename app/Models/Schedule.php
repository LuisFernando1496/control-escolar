<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;
    protected $fillable = ['begin', 'end', 'subject_id',
    'day_id', 'group_id','grade_id', 'teacher_id', 'created_at'];
    public function day(){
        return $this->belongsTo(Day::class);
    }
    public function subject(){
        return $this->belongsTo(Subject::class);
    }
    public function scores(){
        return $this->hasMany(Score::class);
    }
    public function teacher(){
        return $this->belongsTo(User::class,'teacher_id','id');
    }
    public function grade(){
        return $this->belongsTo(Grade::class);
    }
    public function group(){
        return $this->belongsTo(Group::class);
    }
    public function students()
    {
        return $this->belongsToMany(Student::class)->withTimestamps(); //'role_user_table', 'user_id', 'role_id'
    }
}
