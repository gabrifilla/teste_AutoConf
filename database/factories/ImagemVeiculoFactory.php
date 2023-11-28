<?php

namespace Database\Factories;

use App\Models\ImagemVeiculo;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ImagemVeiculo>
 */
class ImagemVeiculoFactory extends Factory
{
    protected $model = ImagemVeiculo::class;

    public function definition()
    {
        return [
            'url' => $this->faker->imageUrl(),
            'veiculo_id' => \App\Models\Veiculo::factory()->create()->id,
        ];
    }
}
