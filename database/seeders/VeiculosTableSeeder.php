<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VeiculosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $marca1Id = DB::table('marcas')->where('nome', 'Toyota')->value('id');
        $marca2Id = DB::table('marcas')->where('nome', 'Chevrolet')->value('id');

        $modelo1Id = DB::table('modelos')->where('nome', 'Corolla Cross')->value('id');
        $modelo2Id = DB::table('modelos')->where('nome', 'Equinox')->value('id');
        $modelo3Id = DB::table('modelos')->where('nome', 'Camaro')->value('id');

        DB::table('veiculos')->insert([
            'marca_id' => $marca1Id,
            'modelo_id' => $modelo1Id,
            'ano' => 2022,
            'cor' => 'Azul',
            'preco' => mt_rand(10000, 5000000) / 100,
        ]);

        DB::table('veiculos')->insert([
            'marca_id' => $marca1Id,
            'modelo_id' => $modelo2Id,
            'ano' => 2022,
            'cor' => 'Azul',
            'preco' => mt_rand(10000, 5000000) / 100,
        ]);

        DB::table('veiculos')->insert([
            'marca_id' => $marca2Id,
            'modelo_id' => $modelo3Id,
            'ano' => 2021,
            'cor' => 'Vermelho',
            'preco' => mt_rand(10000, 5000000) / 100,
        ]);
    }
}
