<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /***
         * Generamos docentes
         */
        $docentes = User::factory(3)->create();
        $role = Role::where("slug", "docente")->first();

        $docentes->each(function($docente) use ($role){
            $docente->roles()->attach($role->id);
        });
    }
}
