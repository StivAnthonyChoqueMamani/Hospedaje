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
        Bedroom::create([
            'nro' => 205,
            'nro_beds' => 1,
            'size_beds' => '1 plaza',
            'floor' => '2-B',
            'is_bath' => false,
            'price' => 30,
        ]);
        Bedroom::create([
            'nro' => 206,
            'nro_beds' => 1,
            'size_beds' => '1 plaza',
            'floor' => '2-B',
            'is_bath' => false,
            'price' => 30,
        ]);
        Bedroom::create([
            'nro' => 207,
            'nro_beds' => 1,
            'size_beds' => '1 plaza',
            'floor' => '2-B',
            'is_bath' => false,
            'price' => 30,
        ]);
        Bedroom::create([
            'nro' => 208,
            'nro_beds' => 1,
            'size_beds' => '1 plaza',
            'floor' => '2-B',
            'is_bath' => false,
            'price' => 30,
        ]);
        Bedroom::create([
            'nro' => 300,
            'nro_beds' => 1,
            'size_beds' => '1 plaza',
            'floor' => '2-B',
            'is_bath' => false,
            'price' => 30,
        ]);
        Bedroom::create([
            'nro' => 301,
            'nro_beds' => 1,
            'size_beds' => '1 plaza',
            'floor' => '2-B',
            'is_bath' => false,
            'price' => 30,
        ]);
        Bedroom::create([
            'nro' => 302,
            'nro_beds' => 1,
            'size_beds' => '1 plaza',
            'floor' => '2-B',
            'is_bath' => false,
            'price' => 30,
        ]);
        Bedroom::create([
            'nro' => 303,
            'nro_beds' => 1,
            'size_beds' => '1 plaza',
            'floor' => '2-B',
            'is_bath' => false,
            'price' => 30,
        ]);
        Bedroom::create([
            'nro' => 304,
            'nro_beds' => 1,
            'size_beds' => '1 plaza',
            'floor' => '2-B',
            'is_bath' => false,
            'price' => 30,
        ]);
        Bedroom::create([
            'nro' => 305,
            'nro_beds' => 1,
            'size_beds' => '1 plaza',
            'floor' => '2-B',
            'is_bath' => false,
            'price' => 30,
        ]);
        
    }
}
