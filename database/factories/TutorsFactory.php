<?php

namespace Database\Factories;

use App\Models\Tutors;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TutorsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Tutors::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $isBanned = $this->faker->boolean;

        return [
            'direccion' => $this->faker->address(),
            'user_id' => User::where('id',rand(1,3))->first()->id,
        ];
    }
}
