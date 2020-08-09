<?php

namespace Modules\Caracterizacion\Entities;

use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ciudadano extends Model
{
    use SoftDeletes;
    protected $table = '';
    protected $keyType = 'string';
    public $incrementing = false;
    //protected $fillable = [];



    public function familias()
    {
        return $this->hasMany('Modules\Caracterizacion\Entities\Familia');
    }
    public function ayudas()
    {
        return $this->hasMany('Modules\Caracterizacion\Entities\Ayuda');
    }





    public static function boot()
    {
        parent::boot();
        self::creating(
            function ($model) {
                $model->id = (string) Uuid::generate(4);
            }
        );
    }

    protected $casts = [
        'id' => 'string'
    ];
}
