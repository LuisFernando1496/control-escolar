<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Grade;

class GradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $grades = [
            [
                "number" => 1,
                "description" => "Primer Grado",
            ],
            [
                "number" => 2,
                "description" => "Segundo Grado",
            ],
            [
                "number" => 3,
                "description" => "Tercer Grado",
            ]
        ];
        foreach ($grades as $grade) {
            Grade::create($grade);
        }
    }
}
