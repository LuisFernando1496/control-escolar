<?php

namespace Database\Seeders;

use App\Models\School;
use Illuminate\Database\Seeder;

class SchoolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        School::create([
            'name'=>'ESCUELA TELESECUNDARIA 649 - JOSE VASCONCELOS CALDERON',
            'boss'=>'MTRO. WALTER CORNELIO GOVEA',
            'email'=>'correo@correo.com',
            'phone'=>'9616969696',
            'logo'=>'/images/logo.png',
            'address'=>'EJIDO CATEDRAL DE CHIAPAS, MPIO. OSTUACAN, CHIAPAS.'
        ]);
    }
}
