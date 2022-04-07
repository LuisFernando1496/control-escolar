<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                "name" => "Administrador",
                "description" => "Administrador del sistema",
                "full_access" => 'yes',
                "slug" => "admin",
                "active" => 1
            ],
            [
                "name" => "Docente",
                "description" => "Docente de la institucion",
                "full_access" => 'no',
                "slug" => "docente",
                "active" => 1
            ],
            [
                "name" => "Alumno",
                "description" => "Alumno de la institucion",
                "full_access" => 'no',
                "slug" => "alumno",
                "active" => 1
            ],
             [
                "name" => "Tutor",
                "description" => "Padre o tutor del alumno",
                "full_access" => 'no',
                "slug" => "tutor",
                "active" => 1
            ],
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
