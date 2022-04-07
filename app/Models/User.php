<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $with = ['student','roles'];
    protected $fillable = [
        'name',
        'lastname1',
        'lastname2',
        'email',
        'password',
        'rfc',
        'key',
        'phone',
        'sex',
        'birthday',
        'active'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];
    public function letters(){
        return $this->hasMany(Letter::class,'signer_id');
    }
    public function notices(){
        return $this->hasMany(Notice::class);
    }
    public function records(){
        return $this->hasMany(Record::class,'teacher_id');
    }
    public function reports(){
        return $this->hasMany(Report::class);
    }
    public function roles(){
        return $this->belongsToMany(Role::class)->withTimesTamps();
    }
    public function student(){
        return $this->hasOne(Student::class);
    }
    public function tutor(){
        return $this->hasOne(Tutors::class);
    }
    public function schedules(){
        return $this->hasMany(Schedule::class,'teacher_id');
    }
    public function assets(){
        return $this->hasMany(Asset::class,'teacher_id');
    }
    public function findRole($slug){
        return in_array($slug, $this->roles->pluck('slug')->toArray());
    }
    public function displayRoles(){
        try {
            return implode("|", $this->roles->pluck('name')->toArray());
        } catch (\Throwable $th) {
            return 'Upss';
        }
    }
    /**
     * se encarga de devolver
     * el slug del usuario 
     * autentificado 
     *
     * @return void
     */
    public function displayRole(){
        try {
            return implode("|", $this->roles->pluck('slug')->toArray());
        } catch (\Throwable $th) {
            return 'Upss';
        }
    }
    public function fullname(){
        return ucwords("{$this->name} {$this->lastname1} {$this->lastname2}");
    }
    public function hasPermission($slug = ''){
        foreach ($this->roles as $role) {
            if($role->full_access === "yes"){
                return true;
            }
            foreach ($role->permissions as $permission) {
                if ($permission->slug === $slug && $permission->active) {
                    return true;
                }
            }
        }
        return false;
    }
}
