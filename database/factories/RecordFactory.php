<?php

namespace Database\Factories;

use App\Models\Record;
use App\Models\Student;
use App\Models\User;
use App\Models\Year;
use App\Models\Grade;
use App\Models\Group;
use Illuminate\Database\Eloquent\Factories\Factory;

class RecordFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Record::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "teacher_id" => User::where('id', rand(1, 3))->first()->id,
            "grade_id" => Grade::where('id', rand(1,3))->first()->id,
            "group_id" => Group::where('id', rand(1,3))->first()->id,
            "year_id" => Year::factory(),
            "student_id" => Student::factory(),
        ];
    }
}
