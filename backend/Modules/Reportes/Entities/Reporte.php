<?php

namespace Modules\Reportes\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use JamesDordoy\LaravelVueDatatable\Traits\LaravelVueDatatableTrait;
use Webpatser\Uuid\Uuid;

class Reporte extends Model {
    use SoftDeletes, LaravelVueDatatableTrait;
    //nombre de la table --------------------------------------------------------->
    protected $table = 'reportes';
    //nombre de la table --------------------------------------------------------->
    protected $keyType = 'string';
    public $incrementing = false;
    //protected $fillable = [];

//Campos Para mostrar en Api, con filtro --------------------------------------------------------->

    protected $dataTableColumns = [
        'id' => ['searchable' => false],
    ];

//Campos Para mostrar en Api, con filtro --------------------------------------------------------->

//Relaciones --------------------------------------------------------->

//Relaciones --------------------------------------------------------->

//Creacion del campo id Uuid --------------------------------------------------------->
    public static function boot() {
        parent::boot();
        self::creating(
            function ($model) {
                $model->id = (string) Uuid::generate(4);
            }
        );
    }

    protected $casts = [
        'id' => 'string',
    ];
//Creacion del campo id Uuid --------------------------------------------------------->

}
