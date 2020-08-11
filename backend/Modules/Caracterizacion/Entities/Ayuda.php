<?php

namespace Modules\Caracterizacion\Entities;

use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;
use Illuminate\Database\Eloquent\SoftDeletes;
use JamesDordoy\LaravelVueDatatable\Traits\LaravelVueDatatableTrait;

class Ayuda extends Model
{
    use SoftDeletes, LaravelVueDatatableTrait;
    //nombre de la table --------------------------------------------------------->
    protected $table = 'ayudas';
    //nombre de la table --------------------------------------------------------->
    protected $keyType = 'string';
    public $incrementing = false;
    //protected $fillable = [];

    //Campos Para mostrar en Api, con filtro --------------------------------------------------------->

    protected $dataTableColumns = [
        // 'lista_ayuda_id' => ['searchable' => true,'order_term' => 'orderable'],
        'cantidad_entregada' => ['searchable' => true, 'order_term' => 'orderable'],
        'fecha_entrega' => ['searchable' => true, 'order_term' => 'orderable'],
    ];

    //Campos Para mostrar en Api, con filtro --------------------------------------------------------->


    //Relaciones --------------------------------------------------------->


    protected $dataTableRelationships = [
        "belongsTo" => [
            "ciudadano" => [
                "model" => \Modules\Caracterizacion\Entities\Ciudadano::class,
                "foreign_key" => "ciudadano_id",
                "columns" => [],
            ],
            "lista" => [
                "model" => \Modules\Caracterizacion\Entities\Lista::class,
                "foreign_key" => "lista_id",
                "columns" => [],
            ],
        ],
    ];


    public function ciudadano()
    {
        return $this->belongsTo('\Modules\Caracterizacion\Entities\Ciudadano');
    }

    public function lista()
    {
        return $this->belongsTo('\Modules\Caracterizacion\Entities\Lista');
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