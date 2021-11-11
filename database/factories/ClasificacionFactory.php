<?php

namespace Database\Factories;

use App\Models\Clasificacion;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClasificacionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Clasificacion::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $fecha = $this->faker->dateTimeThisMonth($max='now');
        return [
            'descripcion' => $this->faker->paragraph($nb = 1),
            'valor' => $this->faker->numberBetween($min = 1,$max = 5),
            'created_at' => $fecha,
            'updated_at' => $fecha,
            'deleted_at' => null
        ];
    }
}
