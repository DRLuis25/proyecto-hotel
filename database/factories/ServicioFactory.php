<?php

namespace Database\Factories;

use App\Models\Servicio;
use Illuminate\Database\Eloquent\Factories\Factory;

class ServicioFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Servicio::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $fecha = $this->faker->dateTimeThisYear($max='now');
        $estado = $this->faker->numberBetween($min = 1, $max = 3);
        $n1 = $this->faker->unique()->numberBetween($min = 1, $max = 100);//->unique()
        //$n2 = $this->faker->numberBetween($min = 1, $max = 50000);
        return [
            'reserva_id' => $n1,
            'empleado_id' => $this->faker->numberBetween($min = 1, $max = 2000),
            'medio_pago_id' => $this->faker->numberBetween($min = 1, $max = 5),
            'comentario' => $this->faker->paragraph($nb = 3),
            'subtotal' => 0,
            'igv' => 0,
            'fecha_entrada' => $fecha,
            'fecha_salida' => $fecha,
            'estado' => $estado,
            'calificacion' => $this->faker->numberBetween($min = 1, $max = 10),
            'created_at' => $fecha,
            'updated_at' => $fecha,
            'deleted_at' => null
        ];
    }
}
