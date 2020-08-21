<?php

namespace Modules\Caracterizacion\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CiudadanoRequest extends FormRequest {
    public function rules() {
        return [
            //
            'tipo_documento' => 'required',
            // 'numero_documento' => 'required|unique:ciudadanos|unique:familias',
            'pep' => 'numeric',
            'nombres' => 'required|string',
            'apellidos' => 'required|string',
            'fecha_expedicion' => 'required|date|date_format:Y-m-d|date_format:Y-m-d',
            'fecha_vencimiento' => 'date|date_format:Y-m-d',
            'fecha_nacimiento' => 'required|date|date_format:Y-m-d',
            'edad' => 'required|numeric',
            'genero' => 'required',
            'estado_civil' => 'string',
            'telefono' => 'numeric',
            'celular' => 'numeric',
            'correo_electronico' => 'email',
            'departamento' => 'required',
            'ciudad' => 'required',
            'barrio' => 'required',
            'comuna' => 'required',
            'direccion' => 'required',
            // 'lat' => 'required',
            // 'let' => 'required',
            'actividad' => 'required|string',
            'ciudad_origen' => 'string',
            'pais_origen' => 'string',
            'fecha_llegada' => 'date|date_format:Y-m-d',
            'intencion_ciudad' => 'string',
            'respuesta_intencion' => 'string',
            'discapacidad' => 'string',
            'salud' => 'string',
            'estudia_actualmente' => 'string',
            'nivel_escolaridad' => 'string',
            'trabajo' => 'string',
            'observaciones' => 'string',
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

    protected function failedValidation(Validator $validator) {
        throw new HttpResponseException(response()->json(['data' => ["valid" => false, "errors" => $validator->errors()], 'status' => '202']));
    }
}
