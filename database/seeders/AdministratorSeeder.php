<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;

class AdministratorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admins = User::factory(2)->create();
        $role = Role::where("slug", "admin")->first();

        $admins->each(function($admin) use ($role){
            $admin->roles()->attach($role->id);
        });
    }
}
