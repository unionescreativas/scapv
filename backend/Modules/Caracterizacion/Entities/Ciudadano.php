<?php

namespace Modules\Caracterizacion\Entities;

use Webpatser\Uuid\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use JamesDordoy\LaravelVueDatatable\Traits\LaravelVueDatatableTrait;

class Ciudadano extends Model
{
    use SoftDeletes, LaravelVueDatatableTrait;
    protected $table = 'ciudadanos';
    protected $keyType = 'string';
    public $incrementing = false;
    //protected $fillable = [];



    protected $dataTableColumns = [
        'id' => ['searchable' => false,],
        'tipo_documento' => ['searchable' => true,],
        'numero_documento' => ['searchable' => true,],
        'pep' => ['searchable' => true,],
        'nombres' => ['searchable' => true,],
        'apellidos' => ['searchable' => true,],
        'fecha_expedicion' => ['searchable' => true,],
        'fecha_vencimiento' => ['searchable' => true,],
        'fecha_nacimiento' => ['searchable' => true,],
        'edad' => ['searchable' => true,],
        'genero' => ['searchable' => true,],
        'estado_civil' => ['searchable' => true,],
        'telefono' => ['searchable' => true,],
        'celular' => ['searchable' => true,],
        'correo_electronico' => ['searchable' => true,],
        'departamento' => ['searchable' => true,],
        'ciudad' => ['searchable' => true,],
        'barrrio' => ['searchable' => true,],
        'comuna' => ['searchable' => true,],
        'dirrecion' => ['searchable' => true,],
        'lat' => ['searchable' => true,],
        'let' => ['searchable' => true,],
        'actividad' => ['searchable' => true,],
        'ciudad_origen' => ['searchable' => true,],
        'pais_origen' => ['searchable' => true,],
        'fecha_llegada' => ['searchable' => true,],
        'intencion_ciudad' => ['searchable' => true,],
        'respuesta_intencion' => ['searchable' => true,],
        'discapacidad' => ['searchable' => true,],
        'salud' => ['searchable' => true,],
        'estudia_actualmente' => ['searchable' => true,],
        'nivel_escolaridad' => ['searchable' => true,],
        'tipo_profesion' => ['searchable' => true,],
        'comunidad_lgtbi' => ['searchable' => true,],
        'comunidad_etnica' => ['searchable' => true,],
        'trabajo' => ['searchable' => true,],
        'tipo_empleo' => ['searchable' => true,],
        'observaciones' => ['searchable' => true,]
    ];

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
