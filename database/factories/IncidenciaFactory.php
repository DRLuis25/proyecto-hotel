<?php

namespace Database\Factories;

use App\Models\Incidencia;
use Illuminate\Database\Eloquent\Factories\Factory;

class IncidenciaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Incidencia::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'habitacion_id' => $this->faker->word,
        'descripcion' => $this->faker->word,
        'fecha' => $this->faker->date('Y-m-d H:i:s'),
        'estado' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s'),
        'deleted_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
