<?php

namespace Database\Factories;

use App\Models\Modelo;
use App\Models\Marca;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Modelo>
 */
class ModeloFactory extends Factory
{
    protected $model = Modelo::class;

    public function definition()
    {
        return [
            'nome' => $this->faker->word,
            'marca_id' => Marca::factory(),
        ];
    }
}
