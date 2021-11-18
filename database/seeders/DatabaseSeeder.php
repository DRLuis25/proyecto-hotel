<?php

namespace Database\Seeders;

use Carbon\Factory;
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
        \App\Models\Cliente::factory(2000)->create();

        //Habitacion: necesita clasificacion
        \App\Models\Clasificacion::factory(2)->create();
        \App\Models\Habitacion::factory(30)->create();


        //Crear una valoración: necesita criterio
        //\App\Models\Criterio::factory(5)->create();
        //Registros
        \App\Models\Reserva::factory(100000)->create()->each(function ($item, $key){
            if($item->estado>1){
                $item->calificacion = rand($min = 1, $max = 10);
            }
        });
        //Por cada registro un Servicio: necesita medio pago
        \App\Models\MedioPago::factory(5)->create();

        \App\Models\Servicio::factory(3000)->create()->each(function ($item, $key)
        {
            $item->created_at = $item->reserva->created_at;
            $item->updated_at = $item->reserva->updated_at;
            $estado = rand($min = 1, $max = 3);
            $item->estado = $estado;
            $item->save();
            //Por cada servicio un detalle Servicio
            //$this->command->getOutput()->writeln($estado);
            if($estado>1){
                for ($i=0; $i < rand($min = 4, $max = 15) ; $i++) {

                    \App\Models\ServicioDetalle::create([
                        'servicio_id'=>$item->id,
                        'producto_id'=>rand($min = 1, $max = 10000),
                        'precio' => rand($min = 20, $max = 200),
                    ]);
                }
                /*\App\Models\ServicioDetalle::factory(rand($min = 1, $max = 10))->make([
                    'servicio_id' => $item->id,
                    'created_at' => $item->created_at,
                    'updated_at' => $item->updated_at
                ]);*/
            }
        });

        /*$usuarios = factory(User::class,100)->create()->each(function ($item, $key)
        {
            $item->assignRole('admin');
        });*/
    }
}
