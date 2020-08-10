<?php

namespace Modules\Caracterizacion\Entities;

use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;
use Illuminate\Database\Eloquent\SoftDeletes;
use JamesDordoy\LaravelVueDatatable\Traits\LaravelVueDatatableTrait;
class Documento extends Model
{
    use SoftDeletes, LaravelVueDatatableTrait;
    //nombre de la table --------------------------------------------------------->
    protected $table = 'documentos';
    //nombre de la table --------------------------------------------------------->
    protected $keyType = 'string';
    public $incrementing = false;
    //protected $fillable = [];

//Campos Para mostrar en Api, con filtro --------------------------------------------------------->

    protected $dataTableColumns = [
        'id' => ['searchable' => false,],
    ];

//Campos Para mostrar en Api, con filtro --------------------------------------------------------->


//Relaciones --------------------------------------------------------->




//Relaciones --------------------------------------------------------->




//Creacion del campo id Uuid --------------------------------------------------------->
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
//Creacion del campo id Uuid --------------------------------------------------------->

}
