<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'key'];
    public function schedules(){
        return $this->hasMany(Schedule::class);
    }
    public function assets(){
        return $this->hasMany(Asset::class);
    }
    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }
    public function scores(){
        return $this->hasMany(Score::class);
    }

    /**
     * filtra el contenido cuando exte metodo 
     * es ejecutado para no actualizar 
     * la key de la materia
     *
     * @param string $keyExcept
     * @return void
     */
    public function except(string $keyExcept)
    {
        $filtered = array_filter($this->attributes, function($values) use($keyExcept){
            return $values != $keyExcept;
        }, ARRAY_FILTER_USE_KEY);
        $this->attributes =  $filtered;
    }
}