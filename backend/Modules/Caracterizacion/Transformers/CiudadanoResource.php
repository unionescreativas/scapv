<?php

namespace Modules\Caracterizacion\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class CiudadanoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'type' => 'ciudadanos',
            'id' => (string) $this->resource->getRouteKey(),
            'attributes' => [
                'tipo_documento' => $this->resource->tipo_documento,
                'numero_documento' => $this->resource->numero_documento,
                'pep' => $this->resource->pep,
                'nombres' => $this->resource->nombres,
                'apellidos' => $this->resource->apellidos,
                'fecha_expedicion' => $this->resource->fecha_expedicion,
                'fecha_vencimiento' => $this->resource->fecha_vencimiento,
                'fecha_nacimiento' => $this->resource->fecha_nacimiento,
                'edad' => $this->resource->edad,
                'genero' => $this->resource->genero,
                'estado_civil' => $this->resource->estado_civil,
                'telefono' => $this->resource->telefono,
                'celular' => $this->resource->celular,
                'correo_electronico' => $this->resource->correo_electronico,
                'departamento' => $this->resource->departamento,
                'ciudad' => $this->resource->ciudad,
                'barrrio' => $this->resource->barrrio,
                'comuna' => $this->resource->comuna,
                'dirrecion' => $this->resource->dirrecion,
                'lat' => $this->resource->lat,
                'let' => $this->resource->let,
                'actividad' => $this->resource->actividad,
                'ciudad_origen' => $this->resource->ciudad_origen,
                'pais_origen' => $this->resource->pais_origen,
                'fecha_llegada' => $this->resource->fecha_llegada,
                'intencion_ciudad' => $this->resource->intencion_ciudad,
                'respuesta_intencion' => $this->resource->respuesta_intencion,
                'discapacidad' => $this->resource->discapacidad,
                'salud' => $this->resource->salud,
                'estudia_actualmente' => $this->resource->estudia_actualmente,
                'nivel_escolaridad' => $this->resource->nivel_escolaridad,
                'tipo_profesion' => $this->resource->tipo_profesion,
                'comunidad_lgtbi' => $this->resource->comunidad_lgtbi,
                'comunidad_etnica' => $this->resource->comunidad_etnica,
                'trabajo' => $this->resource->trabajo,
                'tipo_empleo' => $this->resource->tipo_empleo,
                'observaciones' => $this->resource->observaciones
            ],
        ];
    }
}
