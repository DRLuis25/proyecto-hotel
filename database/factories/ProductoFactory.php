<?php

namespace Database\Factories;

use App\Models\Producto;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Producto::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $fecha = $this->faker->dateTimeThisMonth($max='now');
        return [
            'nombre' => $this->faker->city,
            'descripcion' => $this->faker->paragraph($nb = 8),
            'precio' => $this->faker->numberBetween($min = 10, $max = 1000),
            'stock' => $this->faker->numberBetween($min = 10, $max = 500),
            'created_at' => $fecha,
            'updated_at' => $fecha,
            'deleted_at' => null
        ];
    }
}
