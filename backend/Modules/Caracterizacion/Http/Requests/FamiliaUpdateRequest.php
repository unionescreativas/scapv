<?php

namespace Modules\Caracterizacion\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FamiliaUpdateRequest extends FormRequest {
    public function rules() {
        return [
            //
            'parentesco' => 'required',
            'tipo_documento' => 'required',
            'numero_documento' => 'required|unique:ciudadanos',
            'pep' => 'numeric|nullable',
            'nombres' => 'required|string',
            'apellidos' => 'required|string',
            'fecha_expedicion' => 'required|date|date_format:Y-m-d|date_format:Y-m-d',
            'fecha_vencimiento' => 'date|date_format:Y-m-d|nullable',
            'fecha_nacimiento' => 'required|date|date_format:Y-m-d',
            'edad' => 'required|numeric',
            'genero' => 'required',
            'estado_civil' => 'string|nullable',
            'telefono' => 'numeric|nullable',
            'celular' => 'numeric|nullable',
            'correo_electronico' => 'email|nullable',
            'actividad' => 'string|nullable',
            'ciudad_origen' => 'string|nullable',
            'pais_origen' => 'string|nullable',
            'intencion_ciudad' => 'string|nullable',
            'respuesta_intencion' => 'string|nullable',
            'discapacidad' => 'string|nullable',
            'salud' => 'string|nullable',
            'estudia_actualmente' => 'string|nullable',
            'nivel_escolaridad' => 'string|nullable',
            'trabajo' => 'string|nullable',
            'observaciones' => 'string|nullable',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }
    public function messages() {
        return [
            // 'tipo_documento.required' => 'es requerido',
            // 'numero_documento.required' => '',
        ];
    }
}
