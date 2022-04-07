<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Day;

class DaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $days = [
            array(
                'number' => 1,
                'name' => 'Lunes'
            ),
            array(
                'number' => 2,
                'name' => 'Martes'
            ),
            array(
                'number' => 3,
                'name' => 'Miercoles'
            ),
            array(
                'number' => 4,
                'name' => 'Jueves'
            ),
            array(
                'number' => 5,
                'name' => 'Viernes'
            ),
        ];

        foreach ($days as $day) {
            Day::create($day);
        }
    }
}
