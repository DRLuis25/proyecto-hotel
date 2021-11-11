<?php

namespace Database\Factories;

use App\Models\Empleado;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmpleadoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Empleado::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $fecha = $this->faker->dateTimeThisMonth($max='now');
        return [
            'area_id' => $this->faker->numberBetween($min = 1,$max = 3),
            'cargo_id' => $this->faker->numberBetween($min = 1,$max = 3),
            'nombres' => $this->faker->firstName,
            'apellidos' => $this->faker->lastName,
            'created_at' => $fecha,
            'updated_at' => $fecha,
            'deleted_at' => null
        ];
    }
}
