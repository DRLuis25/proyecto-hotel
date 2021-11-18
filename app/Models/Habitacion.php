<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Habitacion
 * @package App\Models
 * @version November 17, 2021, 8:26 pm UTC
 *
 * @property \App\Models\Clasificacione $clasificacion
 * @property \Illuminate\Database\Eloquent\Collection $incidencias
 * @property \Illuminate\Database\Eloquent\Collection $reservas
 * @property integer $clasificacion_id
 * @property boolean $disponible
 * @property integer $piso
 * @property number $costo
 * @property string $descripcion
 */
class Habitacion extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'habitaciones';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'clasificacion_id',
        'disponible',
        'piso',
        'costo',
        'descripcion'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'clasificacion_id' => 'integer',
        'disponible' => 'boolean',
        'piso' => 'integer',
        'costo' => 'float',
        'descripcion' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'clasificacion_id' => 'required',
        'disponible' => 'required|boolean',
        'piso' => 'required|integer',
        'costo' => 'required|numeric',
        'descripcion' => 'nullable|string',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function clasificacion()
    {
        return $this->belongsTo(\App\Models\Clasificacione::class, 'clasificacion_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function incidencias()
    {
        return $this->hasMany(\App\Models\Incidencia::class, 'habitacion_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function reservas()
    {
        return $this->hasMany(\App\Models\Reserva::class, 'habitacion_id');
    }
}
