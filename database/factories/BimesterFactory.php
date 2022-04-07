<?php

namespace Database\Factories;

use App\Models\Bimester;
use Illuminate\Database\Eloquent\Factories\Factory;

class BimesterFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Bimester::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nombre' => rand(1, 6),
            'description' => "xD"
        ];
    }
}
