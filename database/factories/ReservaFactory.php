<?php

namespace Database\Factories;

use App\Models\Reserva;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReservaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Reserva::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $fecha = $this->faker->dateTimeThisYear($max='now');
        return [
            'habitacion_id' => $this->faker->numberBetween($min = 1, $max = 30),
            'cliente_id' => $this->faker->numberBetween($min = 1, $min = 2000),
            'estado' => $this->faker->numberBetween($min = 1, $max = 3),
            'created_at' => $fecha,
            'updated_at' => $fecha,
            'deleted_at' => null
        ];
    }
}
