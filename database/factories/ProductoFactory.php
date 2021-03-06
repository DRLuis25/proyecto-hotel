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
            'tipo_producto_id' => $this->faker->numberBetween($min = 1,$max = 8),
            'nombre' => $this->faker->city,
            'descripcion' => $this->faker->paragraph($nb = 8),
            'precio' => $this->faker->numberBetween($min = 1, $max = 100),
            'created_at' => $fecha,
            'updated_at' => $fecha,
            'deleted_at' => null
        ];
    }
}
