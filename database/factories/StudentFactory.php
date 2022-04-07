<?php

namespace Database\Factories;

use App\Models\Student;
use App\Models\User;
use App\Models\Blood;
use App\Models\Grade;
use App\Models\Group;
use App\Models\Tutors;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Student::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $isBanned = $this->faker->boolean;

        return [
            'behaviour' => $this->faker->randomDigit(),
            'banned' => $isBanned,
            'end' => false,
            'banned_time' => $isBanned ? $this->faker->dateTime() : NULL,
            'strikes' => 0,
            'paid' => $this->faker->boolean,
            'address' => $this->faker->address(),
            'tutor_id' => User::factory(),
            'blood_id' => Blood::where('id', rand(1, 8))->first()->id,
            'user_id' =>  User::factory(),
            'period' => date('Y-m-d'),
            'current_grade_id' =>  Grade::where('id',rand(1,3))->first()->id,
            'current_group_id' =>  Group::where('id',rand(1,3))->first()->id,
        ];
    }
}
