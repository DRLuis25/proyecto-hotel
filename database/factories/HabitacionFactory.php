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
            'clasificacion_id' => $this->faker->numberBetween($min = 1,$max = 6),
            'disponible' => $this->faker->boolean($chanceOfGettingTrue = 50),
            'piso' => $this->faker->numberBetween($min = 1,$max = 2),
            'costo' => $this->faker->numberBetween($min = 24,$max = 80),
            'descripcion' => $this->faker->text,
            'created_at' => $fecha,
            'updated_at' => $fecha,
            'deleted_at' => null
        ];
    }
}
