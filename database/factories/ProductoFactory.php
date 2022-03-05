<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Producto>
 */
class ProductoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nombre' => 'Producto' . $this->faker->text(5),
            'precio' => $this->faker->randomFloat(2, 0, 1000),
            'descripcion' => $this->faker->text(200),
            'imagen' => $this->faker->imageUrl(640, 480, 'products')
        ];
    }
}
