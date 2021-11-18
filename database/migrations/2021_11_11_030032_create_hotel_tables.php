<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHotelTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clasificaciones', function (Blueprint $table) {
            $table->id();
            $table->string('descripcion');//simple, doble, matrimonial
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('habitaciones', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('clasificacion_id');
            $table->boolean('disponible')->default(true);
            $table->integer('piso');//1, 2 piso
            $table->double('costo');//costo habitación: 24-80
            $table->longText('descripcion')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('clasificacion_id')->references('id')->on('clasificaciones');
        });

        Schema::create('incidencias', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('habitacion_id');
            $table->string('descripcion');
            $table->timestamp('fecha');
            $table->boolean('estado');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('habitacion_id')->references('id')->on('habitaciones');
        });
        /*Schema::create('criterios', function (Blueprint $table) {
            $table->id();
            $table->string('descripcion');
            $table->integer('peso');
            $table->timestamps();
            $table->softDeletes();
        });*/
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string('dni');
            $table->string('nombres');
            $table->string('apellidos');
            $table->string('telefono');
            $table->char('tipo',1);
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('reservas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('habitacion_id');
            $table->unsignedBigInteger('cliente_id');
            $table->integer('estado');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('habitacion_id')->references('id')->on('habitaciones');
            $table->foreign('cliente_id')->references('id')->on('clientes');
        });
        /*Schema::create('valoraciones', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('criterio_id');
            $table->unsignedBigInteger('reserva_id');//Servicio
            $table->integer('valor');
            $table->foreign('criterio_id')->references('id')->on('criterios');
            $table->foreign('reserva_id')->references('id')->on('reservas');
        });*/
        Schema::create('productos', function (Blueprint $table) { //extra
            $table->id();
            $table->string('nombre');
            $table->longText('descripcion');//accesos a campo, piscina, recreación, desayuno almuerzo cena
            $table->decimal('precio');
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('medio_pagos', function (Blueprint $table) {
            $table->id();
            $table->string('descripcion');
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('areas', function (Blueprint $table) {
            $table->id();
            $table->string('descripcion');
            $table->string('actividad');
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('cargos', function (Blueprint $table) {
            $table->id();
            $table->string('descripcion');
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('empleados', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('area_id');
            $table->unsignedBigInteger('cargo_id');
            $table->string('nombres');
            $table->string('apellidos');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('area_id')->references('id')->on('areas');
            $table->foreign('cargo_id')->references('id')->on('cargos');
        });
        Schema::create('servicios', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('reserva_id')->unique();
            $table->unsignedBigInteger('empleado_id');
            $table->unsignedBigInteger('medio_pago_id');
            $table->longText('comentario')->nullable();
            $table->decimal('subtotal');
            $table->decimal('igv');
            $table->timestamp('fecha_entrada');
            $table->timestamp('fecha_salida');
            $table->char('estado',1)->default('1');
            $table->unsignedInteger('calificacion');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('reserva_id')->references('id')->on('reservas');
            $table->foreign('empleado_id')->references('id')->on('empleados');
            $table->foreign('medio_pago_id')->references('id')->on('medio_pagos');
        });
        Schema::create('servicio_detalles', function (Blueprint $table) {
            $table->unsignedBigInteger('servicio_id');
            $table->unsignedBigInteger('producto_id');
            $table->decimal('precio');
            $table->foreign('servicio_id')->references('id')->on('servicios');
            $table->foreign('producto_id')->references('id')->on('productos');
        });
        Schema::create('parametros', function (Blueprint $table) {
            $table->id();
            $table->string('descripcion');
            $table->decimal('valor');
            $table->timestamps();
            $table->softDeletes();
        });

        //Tasas, fechainicio, fechatermino
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hotel_tables');
    }
}
