<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;
    protected $fillable = ['number','description'];
    public function records(){
        return $this->hasMany(Record::class);
    }
    public function schedules(){
        return $this->hasMany(Schedule::class);
    }
    public function subjects(){
        return $this->hasMany(Subject::class);
    }
}
