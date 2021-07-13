<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::insert([
            ['name' => 'superadmin'],
            ['name' => 'admin'],
            ['name' => 'cleaning'],
            ['name' => 'receptionist'],
            ['name' => 'guest'],
        ]);
    }
}
