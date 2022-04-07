<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    protected $fillable = ["title", "description", "path", "subject_id", "teacher_id"];
    use HasFactory;
    public function subject(){
        return $this->belongsTo(Subject::class);
    }
    public function teacher(){
        return $this->belongsTo(User::class,'teacher_id', 'id');
    }
}
