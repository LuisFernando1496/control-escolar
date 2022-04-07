<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Letter extends Model
{
    use HasFactory;
    protected $with = ['signer','student'];
    protected $fillable = ['student_id', 'signer_id','behaviour','path'];
    public function student()
    {
        return $this->belongsTo(Student::class);
    }
    public function signer()
    {
        return $this->belongsTo(User::class,'signer_id','id');
    }
}
