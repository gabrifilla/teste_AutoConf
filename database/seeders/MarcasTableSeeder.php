<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MarcasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('marcas')->insert([
            'nome' => 'Toyota',
        ]);

        DB::table('marcas')->insert([
            'nome' => 'Mercedes-Benz',
        ]);

        DB::table('marcas')->insert([
            'nome' => 'Chevrolet',
        ]);

        DB::table('marcas')->insert([
            'nome' => 'Ferrari',
        ]);

        DB::table('marcas')->insert([
            'nome' => 'Kia',
        ]);

        DB::table('marcas')->insert([
            'nome' => 'Hyundai',
        ]);
    }
}
