<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Blood;

class BloodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
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

        foreach ($bloods as $key => $blood) {
            Blood::create(["name" => $blood]);
        }
    }
}