<?php

namespace Modules\Caracterizacion\Entities;

use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;
use Illuminate\Database\Eloquent\SoftDeletes;
use JamesDordoy\LaravelVueDatatable\Traits\LaravelVueDatatableTrait;

class Transferencia extends Model
{
    use SoftDeletes, LaravelVueDatatableTrait;
    //nombre de la table --------------------------------------------------------->
    protected $table = 'transferencias';
    //nombre de la table --------------------------------------------------------->
    protected $keyType = 'string';
    public $incrementing = false;
    //protected $fillable = [];

    //Campos Para mostrar en Api, con filtro --------------------------------------------------------->

    protected $dataTableColumns = [
        'id' => ['searchable' => false,],
        'parentesco' => ['searchable' => true, 'order_term' => 'orderable'],
    ];

    //Campos Para mostrar en Api, con filtro --------------------------------------------------------->


    //Relaciones --------------------------------------------------------->


    protected $dataTableRelationships = [
        "belongsTo" => [
            "familia" => [
                "model" => \Modules\Caracterizacion\Entities\Familia::class,
                "foreign_key" => "familia_id",
                "columns" => [],
            ],
            "ciudadano" => [
                "model" => \Modules\Caracterizacion\Entities\Ciudadano::class,
                "foreign_key" => "ciudadano_id",
                "columns" => [],
            ],
        ],
    ];

    public function familia()
    {
        return $this->belongsTo(\Modules\Caracterizacion\Entities\Familia::class);
    }

    public function ciudadano()
    {
        return $this->belongsTo(\Modules\Caracterizacion\Entities\Ciudadano::class);
    }
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
