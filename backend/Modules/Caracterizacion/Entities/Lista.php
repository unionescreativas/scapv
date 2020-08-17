<?php

namespace Modules\Caracterizacion\Entities;

use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;
use Illuminate\Database\Eloquent\SoftDeletes;
use JamesDordoy\LaravelVueDatatable\Traits\LaravelVueDatatableTrait;

class Lista extends Model
{
    use SoftDeletes, LaravelVueDatatableTrait;
    //nombre de la table --------------------------------------------------------->
    protected $table = 'listas';
    //nombre de la table --------------------------------------------------------->
    protected $keyType = 'string';
    public $incrementing = false;
    //protected $fillable = [];

    //Campos Para mostrar en Api, con filtro --------------------------------------------------------->

    protected $dataTableColumns = [
        'id' => ['searchable' => false,],
        'nombre_lista' => ['searchable' => true, 'order_term' => 'orderable'],
        'codigo_campo' => ['searchable' => true, 'order_term' => 'orderable'],
        'valor_campo_1' => ['searchable' => true, 'order_term' => 'orderable'],
        'valor_campo_2' => ['searchable' => true, 'order_term' => 'orderable'],
        'valor_campo_3' => ['searchable' => true, 'order_term' => 'orderable'],
        'valor_campo_4' => ['searchable' => true, 'order_term' => 'orderable'],
    ];

    //Campos Para mostrar en Api, con filtro --------------------------------------------------------->


    //Relaciones --------------------------------------------------------->


    public function ayuda()
    {
        return $this->belongsTo('\Modules\Caracterizacion\Entities\Ayuda');
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
