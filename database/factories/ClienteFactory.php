<?php

namespace Database\Factories;

use App\Models\Cliente;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClienteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Cliente::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $fecha = $this->faker->dateTimeThisMonth($max='now');
        return [
            'dni' => $this->faker->numberBetween($min = '10125458',$max = '75154826'),
            'nombres' => $this->faker->firstName,
            'apellidos' => $this->faker->lastName,
            'telefono' => $this->faker->e164PhoneNumber,
            'tipo' => $this->faker->numberBetween($min = 1,$max = 2),
            'created_at' => $fecha,
            'updated_at' => $fecha,
            'deleted_at' => null
        ];
    }
}
