<?php

namespace Database\Factories;

use App\Models\Asset;
use App\Models\Role;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class AssetFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Asset::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $teachers = Role::where('slug','docente')->get()->first()->users;
        $max = $teachers->count();
        return [
            'title'=>$this->faker->title,
            'description'=>$this->faker->text,
            'path'=>$this->faker->url,
            'teacher_id'=>$teachers[$this->faker->numberBetween(0,$max-1)]->id,
            'subject_id'=>$this->faker->numberBetween(1,26)
        ];
    }
}
