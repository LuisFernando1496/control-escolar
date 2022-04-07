<?php

namespace Database\Factories;

use App\Models\Score;
use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;

class ScoreFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Score::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $students = Role::where('slug', '=', 'alumno')->first()->users;
        return [
            "score" => $this->faker->numberBetween(6, 10),
            "approved" => $this->faker->boolean,
            "student_id" => $this->faker->numberBetween(1, count($students))
        ];
    }
}
