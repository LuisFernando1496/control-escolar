<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class PermissionRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permisos = Permission::all();

        $permisos->each(function($perm){
            if($perm->id <= 10){
            Role::where('slug', 'admin')->first()->permissions()->attach($perm->id);
            }
            else if($perm->id > 10 && $perm->id <= 16){
                Role::where('slug', 'docente')->first()->permissions()->attach($perm->id);
            }else{
                Role::where('slug', 'alumno')->first()->permissions()->attach($perm->id);
            }
        });
    }
}
