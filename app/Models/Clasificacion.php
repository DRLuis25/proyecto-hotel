<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Clasificacion
 * @package App\Models
 * @version November 11, 2021, 4:45 am UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection $habitaciones
 * @property string $descripcion
 * @property integer $valor
 */
class Clasificacion extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'clasificaciones';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'descripcion',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'descripcion' => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'descripcion' => 'required|string|max:255',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function habitaciones()
    {
        return $this->hasMany(\App\Models\Habitacione::class, 'clasificacion_id');
    }
}
