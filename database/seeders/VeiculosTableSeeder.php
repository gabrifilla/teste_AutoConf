<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VeiculosTableSeeder extends Seeder
{
    public function run()
    {
        \App\Models\Veiculo::factory(10)->create();
    }
}
