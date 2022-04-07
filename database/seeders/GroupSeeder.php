<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Group;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $grupos = array(
            array(
                'name' => 'A'
            ),
            array(
                'name' => 'B'
            ),
            array(
                'name' => 'C'
            )
        );
        foreach ($grupos as $grupo) {
            Group::create($grupo);
        }
    }
}
