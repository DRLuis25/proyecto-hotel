<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Habitacion
 * @package App\Models
 * @version November 11, 2021, 4:46 am UTC
 *
 * @property \App\Models\Clasificacione $clasificacion
 * @property \Illuminate\Database\Eloquent\Collection $incidencias
 * @property \Illuminate\Database\Eloquent\Collection $registros
 * @property integer $clasificacion_id
 * @property boolean $disponible
 * @property integer $cantidad_personas
 * @property string|\Carbon\Carbon $fecha_registro
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
        'cantidad_personas',
        'fecha_registro'
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
        'cantidad_personas' => 'integer',
        'fecha_registro' => 'datetime'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'clasificacion_id' => 'required',
        'disponible' => 'required|boolean',
        'cantidad_personas' => 'required|integer',
        'fecha_registro' => 'required',
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
    public function registros()
    {
        return $this->hasMany(\App\Models\Registro::class, 'habitacion_id');
    }
}
