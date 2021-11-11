<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::create([
            'name'=>'Luis',
            'email'=>'admin@gmail.com',
            'password'=>'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'
        ]);
        //Millón de usuarios xd
        for ($i=0; $i < 2; $i++) {
            \App\Models\User::factory(200)->create();
        }
        //Productos
        \App\Models\Producto::factory(10000)->create();

        //Empleados: necesita área y cargo
        \App\Models\Area::factory(10)->create();
        \App\Models\Cargo::factory(10)->create();
        \App\Models\Empleado::factory(2000)->create();

        //Clientes
        \App\Models\Cliente::factory(10000)->create();

        //Habitacion: necesita clasificacion
        \App\Models\Clasificacion::factory(2)->create();
        \App\Models\Habitacion::factory(30)->create();

        //Registros

        //Por cada registro un Servicio: necesita medio pago

        //Por cada servicio un detalle Servicio

        //Crear una valoración: necesita criterio
    }
}
