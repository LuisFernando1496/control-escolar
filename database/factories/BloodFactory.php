<?php

namespace Database\Factories;

use App\Models\Blood;
use Illuminate\Database\Eloquent\Factories\Factory;

class BloodFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Blood::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $bloods = [
            1 => "A+",
            2 => "A-",
            3 => "B+",
            4 => "B+",
            5 => "O+",
            6 => "O-",
            7 => "AB+",
            8 => "AB-"
        ];
        return [
            'name' => rand(1, 8)
        ];
    }
}
