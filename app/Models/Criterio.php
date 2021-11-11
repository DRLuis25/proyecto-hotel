<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Criterio
 * @package App\Models
 * @version November 11, 2021, 4:43 am UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection $valoraciones
 * @property string $descripcion
 * @property integer $peso
 */
class Criterio extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'criterios';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'descripcion',
        'peso'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'descripcion' => 'string',
        'peso' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'descripcion' => 'required|string|max:255',
        'peso' => 'required|integer',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function valoraciones()
    {
        return $this->hasMany(\App\Models\Valoracione::class, 'criterio_id');
    }
}
