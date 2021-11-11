<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Servicio
 * @package App\Models
 * @version November 11, 2021, 4:48 am UTC
 *
 * @property \App\Models\Cliente $cliente
 * @property \App\Models\MedioPago $medioPago
 * @property \App\Models\Empleado $empleado
 * @property \Illuminate\Database\Eloquent\Collection $productos
 * @property integer $cliente_id
 * @property integer $empleado_id
 * @property integer $medio_pago_id
 * @property string $comentario
 * @property number $subtotal
 * @property number $igv
 * @property integer $stock
 * @property string|\Carbon\Carbon $fecha
 * @property string $estado
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
        'cliente_id',
        'empleado_id',
        'medio_pago_id',
        'comentario',
        'subtotal',
        'igv',
        'stock',
        'fecha',
        'estado'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'cliente_id' => 'integer',
        'empleado_id' => 'integer',
        'medio_pago_id' => 'integer',
        'comentario' => 'string',
        'subtotal' => 'decimal:2',
        'igv' => 'decimal:2',
        'stock' => 'integer',
        'fecha' => 'datetime',
        'estado' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'cliente_id' => 'required',
        'empleado_id' => 'required',
        'medio_pago_id' => 'required',
        'comentario' => 'nullable|string|max:255',
        'subtotal' => 'required|numeric',
        'igv' => 'required|numeric',
        'stock' => 'required|integer',
        'fecha' => 'required',
        'estado' => 'required|string|max:1',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function cliente()
    {
        return $this->belongsTo(\App\Models\Cliente::class, 'cliente_id');
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
