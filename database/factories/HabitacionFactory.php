<?php

namespace Database\Factories;

use App\Models\Habitacion;
use Illuminate\Database\Eloquent\Factories\Factory;

class HabitacionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Habitacion::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $fecha = $this->faker->dateTimeThisMonth($max='now');
        return [
            'clasificacion_id' => $this->faker->numberBetween($min = 1,$max = 2),
            'disponible' => $this->faker->boolean($chanceOfGettingTrue = 50),
            'cantidad_personas' => $this->faker->numberBetween($min = 1,$max = 3),
            'fecha_registro' => $this->faker->dateTimeThisYear($max = 'now'),
            'created_at' => $fecha,
            'updated_at' => $fecha,
            'deleted_at' => null
        ];
    }
}
