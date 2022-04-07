<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    use HasFactory;
    protected $fillable = [
        'group_id', 'grade_id',
        'student_id', 'score'
    ];
    public function grade(){
        return $this->belongsTo(Grade::class);
    }
    public function group(){
        return $this->belongsTo(Group::class);
    }
    public function student(){
        return $this->belongsTo(Student::class);
    }
}
