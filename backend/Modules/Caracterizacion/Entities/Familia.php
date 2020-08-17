<?php

namespace Modules\Caracterizacion\Entities;

use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;
use Illuminate\Database\Eloquent\SoftDeletes;
use JamesDordoy\LaravelVueDatatable\Traits\LaravelVueDatatableTrait;

class Familia extends Model
{
    use SoftDeletes, LaravelVueDatatableTrait;
    //nombre de la table --------------------------------------------------------->
    protected $table = 'familias';
    //nombre de la table --------------------------------------------------------->
    protected $keyType = 'string';
    public $incrementing = false;
    //protected $fillable = [];

    //Campos Para mostrar en Api, con filtro --------------------------------------------------------->

    protected $dataTableColumns = [
        'id' => ['searchable' => false],
        'parentesco' => ['searchable' => true, 'order_term' => 'orderable'],
        'tipo_documento' => ['searchable' => true, 'order_term' => 'orderable'],
        'numero_documento' => ['searchable' => true, 'order_term' => 'orderable'],
        'pep' => ['searchable' => true, 'order_term' => 'orderable'],
        'nombres' => ['searchable' => true, 'order_term' => 'orderable'],
        'apellidos' => ['searchable' => true, 'order_term' => 'orderable'],
        'fecha_expedicion' => ['searchable' => true, 'order_term' => 'orderable'],
        'fecha_vencimiento' => ['searchable' => true, 'order_term' => 'orderable'],
        'fecha_nacimiento' => ['searchable' => true, 'order_term' => 'orderable'],
        'edad' => ['searchable' => true, 'order_term' => 'orderable'],
        'genero' => ['searchable' => true, 'order_term' => 'orderable'],
        'estado_civil' => ['searchable' => true, 'order_term' => 'orderable'],
        'telefono' => ['searchable' => true, 'order_term' => 'orderable'],
        'celular' => ['searchable' => true, 'order_term' => 'orderable'],
        'correo_electronico' => ['searchable' => true, 'order_term' => 'orderable'],
        'departamento' => ['searchable' => true, 'order_term' => 'orderable'],
        'ciudad' => ['searchable' => true, 'order_term' => 'orderable'],
        'barrio' => ['searchable' => true, 'order_term' => 'orderable'],
        'comuna' => ['searchable' => true, 'order_term' => 'orderable'],
        'direcion' => ['searchable' => true, 'order_term' => 'orderable'],
        'actividad' => ['searchable' => true, 'order_term' => 'orderable'],
        'ciudad_origen' => ['searchable' => true, 'order_term' => 'orderable'],
        'pais_origen' => ['searchable' => true, 'order_term' => 'orderable'],
        'fecha_llegada' => ['searchable' => true, 'order_term' => 'orderable'],
        'intencion_ciudad' => ['searchable' => true, 'order_term' => 'orderable'],
        'respuesta_intencion' => ['searchable' => true, 'order_term' => 'orderable'],
        'fecha_llegada' => ['searchable' => true, 'order_term' => 'orderable'],
        'discapacidad' => ['searchable' => true, 'order_term' => 'orderable'],
        'salud' => ['searchable' => true, 'order_term' => 'orderable'],
        'estudia_actualmente' => ['searchable' => true, 'order_term' => 'orderable'],
        'nivel_escolaridad' => ['searchable' => true, 'order_term' => 'orderable'],
        'tipo_profesion' => ['searchable' => true, 'order_term' => 'orderable'],
        'comunidad_lgtbi' => ['searchable' => true, 'order_term' => 'orderable'],
        'comunidad_etnica' => ['searchable' => true, 'order_term' => 'orderable'],
        'trabajo' => ['searchable' => true, 'order_term' => 'orderable'],
        'tipo_empleo' => ['searchable' => true, 'order_term' => 'orderable'],
        'observaciones' => ['searchable' => true, 'order_term' => 'orderable'],
    ];

    //Campos Para mostrar en Api, con filtro --------------------------------------------------------->

    protected $dataTableRelationships = [
        "belongsTo" => [
            "ciudadano" => [
                "model" => \Modules\Caracterizacion\Entities\Ciudadano::class,
                "foreign_key" => "ciudadano_id",
                "columns" => [
                    'numero_documento' => ['searchable' => true, 'order_term' => 'orderable'],
                    'pep' => ['searchable' => true, 'order_term' => 'orderable'],
                    'nombres' => ['searchable' => true, 'order_term' => 'orderable'],
                    'apellidos' => ['searchable' => true, 'order_term' => 'orderable'],
                ],
            ],
        ],
    ];


    //Relaciones --------------------------------------------------------->


    public function ciudadano()
    {
        return $this->belongsTo('\Modules\Caracterizacion\Entities\Ciudadano');
    }
    public function transferencia()
    {
        return $this->hasMany('Modules\Caracterizacion\Entities\Transferencia');
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
