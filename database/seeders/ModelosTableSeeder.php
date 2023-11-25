<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ModelosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brand1Id = DB::table('marcas')->where('nome', 'Chevrolet')->value('id');
        $brand2Id = DB::table('marcas')->where('nome', 'Toyota')->value('id');

        DB::table('modelos')->insert([
            'nome' => 'Camaro',
            'marca_id' => $brand1Id
        ]);

        DB::table('modelos')->insert([
            'nome' => 'Equinox',
            'marca_id' => $brand1Id
        ]);

        DB::table('modelos')->insert([
            'nome' => 'Corolla Cross',
            'marca_id' => $brand2Id
        ]);
    }
}
