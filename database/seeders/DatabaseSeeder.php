<?php

namespace Database\Seeders;

use Carbon\Factory;
use Illuminate\Database\Seeder;
use Faker\Generator;
use Illuminate\Container\Container;

class DatabaseSeeder extends Seeder
{
    private $sub;
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
        \App\Models\User::factory(50)->create();

        \App\Models\TipoProducto::factory(8)->create(); //! falta
        //Productos: necesita categoria
        \App\Models\Producto::factory(122)->create();

        //Empleados: necesita área y cargo
        \App\Models\Area::factory(10)->create();
        \App\Models\Cargo::factory(10)->create();
        \App\Models\Empleado::factory(200)->create();

        //Clientes
        \App\Models\Cliente::factory(5000)->create();

        //Habitacion: necesita clasificacion
        \App\Models\Clasificacion::factory(6)->create();
        \App\Models\Habitacion::factory(30)->create();

        //Por cada reserva un Servicio: necesita medio pago
        \App\Models\MedioPago::factory(5)->create();

        //print(Container::getInstance()->make(Generator::class)->($max='now'));

        //Registros
        for ($i=0; $i < 10; $i++) {
            \App\Models\Reserva::factory(100000)->create()->each(function ($itemReserva, $keyReserva){
                if($itemReserva->estado>2){
                    $this->sub = 0;
                    $service = \App\Models\Servicio::create([
                        'reserva_id'=>$itemReserva->id,
                        'empleado_id' => rand($min = 1, $max = 200),
                        'medio_pago_id' => rand($min = 1, $max = 5),
                        'comentario' => null,
                        'subtotal' => 0,
                        'igv' => 0,
                        'fecha_entrada' => $itemReserva->created_at,
                        'fecha_salida' => $itemReserva->created_at,
                        'estado' => rand($min = 1, $max = 3),
                        'calificacion' => rand($min = 1, $max = 10),
                        'created_at' => $itemReserva->created_at,
                        'updated_at' => $itemReserva->updated_at,
                    ]);
                    //Por cada servicio uno o varios detalle Servicio
                    if($service->estado>1){
                        $n = rand($min = 4, $max = 15);
                        $sum = 0;
                        for ($i=0; $i < $n ; $i++) {
                            $p = rand($min = 20, $max = 200);
                            \App\Models\ServicioDetalle::create([
                                'servicio_id'=>$service->id,
                                'producto_id'=>rand($min = 1, $max = 122),
                                'precio' => $p,
                            ]);
                            $sum += $p;
                        }
                        $this->sub = $sum;
                    }
                    $igv = $this->sub*0.18;
                    $service->igv = $igv;
                    $service->subtotal = $this->sub;
                    $service->save();
                }
            });
        }

    }
}
