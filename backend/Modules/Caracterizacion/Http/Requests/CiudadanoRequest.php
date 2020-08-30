<?php

namespace Modules\Caracterizacion\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CiudadanoRequest extends FormRequest {
    public function rules() {
        return [
            'tipo_documento' => 'required',
            'numero_documento' => 'required|unique:familias',
            'pep' => 'numeric|nullable',
            'nombres' => 'required|string',
            'apellidos' => 'required|string',
            'fecha_expedicion' => 'required|date|date_format:Y-m-d',
            'fecha_vencimiento' => 'date|date_format:Y-m-d|nullable',
            'fecha_nacimiento' => 'required|date|date_format:Y-m-d',
            'edad' => 'required|numeric',
            'genero' => 'required',
            'estado_civil' => 'string|nullable',
            'telefono' => 'numeric|nullable',
            'celular' => 'numeric|nullable',
            'correo_electronico' => 'email|nullable',
            'departamento' => 'required',
            'ciudad' => 'required',
            'barrio' => 'required',
            'comuna' => 'required',
            'direccion' => 'required',
            'actividad' => 'string|nullable',
            'ciudad_origen' => 'string|nullable',
            'pais_origen' => 'string|nullable',
            'fecha_llegada' => 'date|date_format:Y-m-d|nullable',
            'intencion_ciudad' => 'string|nullable',
            'respuesta_intencion' => 'string|nullable',
            'discapacidad' => 'string|nullable',
            'salud' => 'string|nullable',
            'estudia_actualmente' => 'string|nullable',
            'tipo_profesion' => 'string|nullable',
            'nivel_escolaridad' => 'string|nullable',
            'comunidad_lgtbi' => 'string|nullable',
            'comunidad_etnica' => 'string|nullable',
            'trabajo' => 'string|nullable',
            'tipo_empleo' => 'string|nullable',
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

    protected function failedValidation(Validator $validator) {
        throw new HttpResponseException(response()->json(['data' => ["valid" => false, "errors" => $validator->errors()], 'status' => '202']));
    }
}
