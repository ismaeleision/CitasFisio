<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\cita>
 */
class CitaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'fecha' => $this->faker->dateTimeBetween('-1 week', '+2 week'),
            'hora' => $this->faker->numberBetween(10, 20),
            'observaciones' => $this->faker->text(150),
            'user_id' => $this->faker->numberBetween(1, 2),
            'servicio_id' => $this->faker->numberBetween(1, 5)
        ];
    }
}
