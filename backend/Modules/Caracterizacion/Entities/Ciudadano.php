<?php

namespace Modules\Caracterizacion\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use JamesDordoy\LaravelVueDatatable\Traits\LaravelVueDatatableTrait;
use Webpatser\Uuid\Uuid;

class Ciudadano extends Model {
    use SoftDeletes, LaravelVueDatatableTrait;
    protected $table = 'ciudadanos';
    protected $keyType = 'string';
    public $incrementing = false;
    //protected $fillable = [];

    protected $dataTableColumns = [
        'id' => ['searchable' => false],
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
        'direccion' => ['searchable' => true, 'order_term' => 'orderable'],
        'lat' => ['searchable' => true, 'order_term' => 'orderable'],
        'let' => ['searchable' => true, 'order_term' => 'orderable'],
        'actividad' => ['searchable' => true, 'order_term' => 'orderable'],
        'ciudad_origen' => ['searchable' => true, 'order_term' => 'orderable'],
        'pais_origen' => ['searchable' => true, 'order_term' => 'orderable'],
        'fecha_llegada' => ['searchable' => true, 'order_term' => 'orderable'],
        'intencion_ciudad' => ['searchable' => true, 'order_term' => 'orderable'],
        'respuesta_intencion' => ['searchable' => true, 'order_term' => 'orderable'],
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
    protected $dataTableRelationships = [
        "hasMany" => [
            "ayudas" => [
                "model" => \Modules\Caracterizacion\Entities\Ayuda::class,
                "foreign_key" => "ciudadano_id",
                "columns" => [
                    'ayudas.id' => ['searchable' => true, 'order_term' => 'orderable'],
                    'cantidad_entregada' => ['searchable' => true, 'order_term' => 'orderable'],
                    'fecha_entrega' => ['searchable' => true, 'order_term' => 'orderable'],
                ],
            ],

        ],
    ];
    public function transferencia() {
        return $this->hasMany('Modules\Caracterizacion\Entities\Transferencia');
    }

    public function familias() {
        return $this->hasMany('Modules\Caracterizacion\Entities\Familia');
    }
    public function ayudas() {
        return $this->hasMany('Modules\Caracterizacion\Entities\Ayuda');
    }

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
}
