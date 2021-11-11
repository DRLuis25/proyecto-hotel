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
            $table->string('descripcion');
            $table->integer('valor');
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('habitaciones', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('clasificacion_id');
            $table->boolean('disponible')->default(true);
            $table->integer('cantidad_personas');
            $table->timestamp('fecha_registro');
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
        Schema::create('criterios', function (Blueprint $table) {
            $table->id();
            $table->string('descripcion');
            $table->integer('peso');
            $table->timestamps();
            $table->softDeletes();
        });
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
        Schema::create('registros', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('habitacion_id');
            $table->unsignedBigInteger('cliente_id');
            $table->integer('peso');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('habitacion_id')->references('id')->on('habitaciones');
            $table->foreign('cliente_id')->references('id')->on('clientes');
        });
        Schema::create('valoraciones', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('criterio_id');
            $table->unsignedBigInteger('registro_id');
            $table->integer('valor');
            $table->foreign('criterio_id')->references('id')->on('criterios');
            $table->foreign('registro_id')->references('id')->on('registros');
        });
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->longText('descripcion');
            $table->decimal('precio');
            $table->unsignedInteger('stock');
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
            $table->unsignedBigInteger('cliente_id');
            $table->unsignedBigInteger('empleado_id');
            $table->unsignedBigInteger('medio_pago_id');
            $table->string('comentario')->nullable();
            $table->decimal('subtotal');
            $table->decimal('igv');
            $table->unsignedInteger('stock');
            $table->timestamp('fecha');
            $table->char('estado',1)->default('1');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('cliente_id')->references('id')->on('clientes');
            $table->foreign('empleado_id')->references('id')->on('empleados');
            $table->foreign('medio_pago_id')->references('id')->on('medio_pagos');
        });
        Schema::create('servicio_detalles', function (Blueprint $table) {
            $table->unsignedBigInteger('servicio_id');
            $table->unsignedBigInteger('producto_id');
            $table->decimal('precio');
            $table->unsignedInteger('cantidad');
            $table->foreign('servicio_id')->references('id')->on('servicios');
            $table->foreign('producto_id')->references('id')->on('productos');
        });
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
