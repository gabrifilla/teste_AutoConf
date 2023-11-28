<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ImagemVeiculo;

class ImagemVeiculosTableSeeder extends Seeder
{
    public function run()
    {
        ImagemVeiculo::factory()->count(10)->create();
    }
}
