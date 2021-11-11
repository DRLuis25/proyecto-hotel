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
        return [
            'cliente_id' => $this->faker->word,
            'empleado_id' => $this->faker->word,
            'medio_pago_id' => $this->faker->word,
            'comentario' => $this->faker->word,
            'subtotal' => $this->faker->word,
            'igv' => $this->faker->word,
            'stock' => $this->faker->randomDigitNotNull,
            'fecha' => $this->faker->date('Y-m-d H:i:s'),
            'estado' => $this->faker->word,
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s'),
            'deleted_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
