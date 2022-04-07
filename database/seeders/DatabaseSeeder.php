<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(20)->create();
        // \App\Models\Student::factory(3)->create();


        /* Firsh ejecution */
         $this->call([
             BimesterSeeder::class,
             BloodSeeder::class,
             DaySeeder::class,
             GradeSeeder::class,
             GroupSeeder::class,
             StageSeeder::class,
             SubjectSeeder::class,
             PermissionSeeder::class,
             RoleSeeder::class,
             PermissionRoleSeeder::class,
             TeacherSeeder::class,
             AdministratorSeeder::class,
             StudentSeeder::class,
             TutorsSeeder::class,
            //  OneYearSeeder::class, //crea alumno, horario, score y record
             ScheduleSeeder::class,
             SchoolSeeder::class,
             AssetSeeder::class

         ]);
    }
}
