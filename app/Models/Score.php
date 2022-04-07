<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    use HasFactory;
    protected $fillable = ['score','approved','student_id',
    'bimester_id','subject_id'];
    public function bimester(){
        return $this->belongsTo(Bimester::class);
    }
    public function subject(){
        return $this->belongsTo(Subject::class);
    }
    public function student(){
        return $this->belongsTo(Student::class);
    }

    /**
     * Scope para buscar el ultimo
     * bimestre en el que el alumno
     * va actualmente
     *
     * @param QueryBuilder $query
     * @param int $user
     * @return void
     */
    public function scopeLastBimester($query, $user)
    {
        return $query->where("bimester_id", function ($query) use ($user){
				$query
					->select("bimester_id")
					->from("scores")
					->where("student_id", $user)
					->latest("bimester_id")
					->first();
			});
    }
}
