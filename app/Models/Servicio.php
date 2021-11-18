<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Servicio
 * @package App\Models
 * @version November 17, 2021, 8:37 pm UTC
 *
 * @property \App\Models\Reserva $reserva
 * @property \App\Models\MedioPago $medioPago
 * @property \App\Models\Empleado $empleado
 * @property \Illuminate\Database\Eloquent\Collection $productos
 * @property integer $reserva_id
 * @property integer $empleado_id
 * @property integer $medio_pago_id
 * @property string $comentario
 * @property number $subtotal
 * @property number $igv
 * @property string|\Carbon\Carbon $fecha_entrada
 * @property string|\Carbon\Carbon $fecha_salida
 * @property string $estado
 * @property integer $calificacion
 */
class Servicio extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'servicios';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'reserva_id',
        'empleado_id',
        'medio_pago_id',
        'comentario',
        'subtotal',
        'igv',
        'fecha_entrada',
        'fecha_salida',
        'estado',
        'calificacion'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'reserva_id' => 'integer',
        'empleado_id' => 'integer',
        'medio_pago_id' => 'integer',
        'comentario' => 'string',
        'subtotal' => 'decimal:2',
        'igv' => 'decimal:2',
        'fecha_entrada' => 'datetime',
        'fecha_salida' => 'datetime',
        'estado' => 'string',
        'calificacion' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'reserva_id' => 'required',
        'empleado_id' => 'required',
        'medio_pago_id' => 'required',
        'comentario' => 'nullable|string',
        'subtotal' => 'required|numeric',
        'igv' => 'required|numeric',
        'fecha_entrada' => 'required',
        'fecha_salida' => 'required',
        'estado' => 'required|string|max:1',
        'calificacion' => 'required|integer',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function reserva()
    {
        return $this->belongsTo(\App\Models\Reserva::class, 'reserva_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function medioPago()
    {
        return $this->belongsTo(\App\Models\MedioPago::class, 'medio_pago_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function empleado()
    {
        return $this->belongsTo(\App\Models\Empleado::class, 'empleado_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    public function productos()
    {
        return $this->belongsToMany(\App\Models\Producto::class, 'servicio_detalles');
    }
}
