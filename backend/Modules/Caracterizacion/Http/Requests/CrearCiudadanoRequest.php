<?php

namespace Modules\Caracterizacion\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CrearCiudadanoRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
            'tipo_documento' => 'required',
            'numero_documento' => 'required|unique:ciudadanos|unique:familias',
            'pep' => 'string',
            'nombres' => 'required|string',
            'apellidos' => 'required|string',
            'fecha_expedicion' => 'required|date',
            'fecha_vencimiento' => 'date',
            'fecha_nacimiento' => 'date',
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
            'direcion' => 'required',
            'lat' => 'required',
            'let' => 'required',
            'actividad' => 'string',
            'ciudad_origen' => 'string',
            'pais_origen' => 'string',
            'fecha_llegada' => 'date',
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
    public function authorize()
    {
        return true;
    }
    public function messages()
    {
        return [
            // 'tipo_documento.required' => 'es requerido',
            // 'numero_documento.required' => '',
        ];
    }
}
