<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class ServicioDetalle
 * @package App\Models
 * @version November 17, 2021, 8:41 pm UTC
 *
 * @property \App\Models\Producto $producto
 * @property \App\Models\Servicio $servicio
 * @property integer $servicio_id
 * @property integer $producto_id
 * @property number $precio
 */
class ServicioDetalle extends Model
{

    use HasFactory;

    public $table = 'servicio_detalles';
    public $timestamps = false;
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'servicio_id',
        'producto_id',
        'precio'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'servicio_id' => 'integer',
        'producto_id' => 'integer',
        'precio' => 'decimal:2'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'servicio_id' => 'required',
        'producto_id' => 'required',
        'precio' => 'required|numeric'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function producto()
    {
        return $this->belongsTo(\App\Models\Producto::class, 'producto_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function servicio()
    {
        return $this->belongsTo(\App\Models\Servicio::class, 'servicio_id');
    }
}
