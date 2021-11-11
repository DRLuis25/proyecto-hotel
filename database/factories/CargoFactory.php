<?php

namespace Database\Factories;

use App\Models\Cargo;
use Illuminate\Database\Eloquent\Factories\Factory;

class CargoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Cargo::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $fecha = $this->faker->dateTimeThisMonth($max='now');
        return [
            'descripcion' => $this->faker->word,
            'created_at' => $fecha,
            'updated_at' => $fecha,
            'deleted_at' => null
        ];
    }
}
