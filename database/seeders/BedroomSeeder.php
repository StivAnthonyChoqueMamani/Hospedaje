<?php

namespace Database\Seeders;

use App\Models\Bedroom;
use Illuminate\Database\Seeder;

class BedroomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Bedroom::create([
            'nro' => 201,
            'nro_beds' => 1,
            'size_beds' => '2 plaza',
            'floor' => '2-A',
            'is_bath' => true,
            'price' => 30,
        ]);
        Bedroom::create([
            'nro' => 202,
            'nro_beds' => 2,
            'size_beds' => '1 1/2 plaza',
            'floor' => '2-A',
            'is_bath' => true,
            'price' => 30,
        ]);
        Bedroom::create([
            'nro' => 203,
            'nro_beds' => 1,
            'size_beds' => '2 plaza',
            'floor' => '2-A',
            'is_bath' => true,
            'price' => 30,
        ]);
        Bedroom::create([
            'nro' => 204,
            'nro_beds' => 1,
            'size_beds' => '1 plaza',
            'floor' => '2-B',
            'is_bath' => false,
            'price' => 30,
        ]);
    }
}
