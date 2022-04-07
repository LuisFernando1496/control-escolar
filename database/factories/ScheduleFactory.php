<?php

namespace Database\Factories;

use App\Models\Schedule;
use App\Models\Record;
use App\Models\Grade;
use App\Models\Group;
use App\Models\Day;
use App\Models\User;

use Illuminate\Database\Eloquent\Factories\Factory;

class ScheduleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Schedule::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "subject_id" => $this->faker->numberBetween(1, 6)
        ];
    }
}
