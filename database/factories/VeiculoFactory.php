<?php

namespace Database\Factories;

use App\Models\Veiculo;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Veiculo>
 */
class VeiculoFactory extends Factory
{
    protected $model = Veiculo::class;

    public function definition()
    {
        return [
            'marca_id' => \App\Models\Marca::factory()->create()->id,
            'modelo_id' => \App\Models\Modelo::factory()->create()->id,
            'ano' => $this->faker->year,
            'cor' => $this->faker->colorName,
            'preco' => $this->faker->randomFloat(2, 10000, 50000),
        ];
    }
}
