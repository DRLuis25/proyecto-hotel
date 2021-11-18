<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Reserva
 * @package App\Models
 * @version November 17, 2021, 8:35 pm UTC
 *
 * @property \App\Models\Habitacione $habitacion
 * @property \App\Models\Cliente $cliente
 * @property \Illuminate\Database\Eloquent\Collection $servicios
 * @property integer $habitacion_id
 * @property integer $cliente_id
 * @property integer $estado
 */
class Reserva extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'reservas';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'habitacion_id',
        'cliente_id',
        'estado'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'habitacion_id' => 'integer',
        'cliente_id' => 'integer',
        'estado' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'habitacion_id' => 'required',
        'cliente_id' => 'required',
        'estado' => 'required|integer',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function habitacion()
    {
        return $this->belongsTo(\App\Models\Habitacione::class, 'habitacion_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function cliente()
    {
        return $this->belongsTo(\App\Models\Cliente::class, 'cliente_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function servicios()
    {
        return $this->hasMany(\App\Models\Servicio::class, 'reserva_id');
    }
}
