<?php

namespace Database\Factories;

use App\Models\Area;
use Illuminate\Database\Eloquent\Factories\Factory;

class AreaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Area::class;

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
            'actividad' => $this->faker->word,
            'created_at' => $fecha,
            'updated_at' => $fecha,
            'deleted_at' => null
        ];
    }
}
