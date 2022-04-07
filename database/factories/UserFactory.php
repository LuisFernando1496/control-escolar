<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->firstName($gender = 'male'|'female'),
            'lastname1' => $this->faker->lastName,
            'lastname2' => $this->faker->lastName,
            'rfc' => $this->faker->regexify("[A-Z]{4}[0-9]{6}[A-Z]{1}[1-9]{1}[A-Z]{1}"),
            'curp' => $this->faker->regexify("[A-Z]{4}[0-9]{6}[A-Z]{6}[1-9]{2}"),
            'key' => $this->faker->regexify("[1-9]{8}"),
            'phone' => $this->faker->regexify("961[1-9]{7}"),
            'sex' => $this->faker->boolean,
            'birthday' => $this->faker->date,
            'active' => $this->faker->boolean,
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ];
    }
}
