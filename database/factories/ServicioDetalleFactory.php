<?php

namespace Database\Factories;

use App\Models\ServicioDetalle;
use Illuminate\Database\Eloquent\Factories\Factory;

class ServicioDetalleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ServicioDetalle::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'servicio_id' => $this->faker->word,
            'producto_id' => $this->faker->numberBetween($min = 1,$max = 10000),
            'precio' => $this->faker->numberBetween($min = 1,$max = 100),
        ];
    }
}
