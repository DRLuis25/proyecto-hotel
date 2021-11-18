<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Valoracion
 * @package App\Models
 * @version November 11, 2021, 4:44 am UTC
 *
 * @property \App\Models\Criterio $criterio
 * @property \App\Models\Registro $registro
 * @property integer $criterio_id
 * @property integer $registro_id
 * @property integer $valor
 */
class Valoracion extends Model
{

    use HasFactory;

    public $table = 'valoraciones';
    public $timestamps = false;



    public $fillable = [
        'criterio_id',
        'reserva_id',
        'valor'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'criterio_id' => 'integer',
        'registro_id' => 'integer',
        'valor' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'criterio_id' => 'required',
        'registro_id' => 'required',
        'valor' => 'required|integer'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function criterio()
    {
        return $this->belongsTo(\App\Models\Criterio::class, 'criterio_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function registro()
    {
        return $this->belongsTo(\App\Models\Registro::class, 'registro_id');
    }
}
