<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;
use App\Models\Role;
use App\Models\Tutors;
class StudentSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$students = Student::factory(2)->create();
		$role = Role::where("slug","alumno")->first();
		$students->each(function ($student) use ($role) {
			$student->user->roles()->attach($role->id);
		});
		
	}
}
