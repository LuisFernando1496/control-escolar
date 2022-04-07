<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Tutors;
use App\Models\Role;
class TutorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tutors = User::factory(2)->create();
        $tutoraddres = Tutors::factory(2)->create();
		$role = Role::where("slug","tutor")->first();
		$tutors->each(function ($tutor) use ($role) {
			$tutor->roles()->attach($role->id);
		});
    }
}
