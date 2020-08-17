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
            // 'pep' => 'required',
            'nombres' => 'required',
            'apellidos' => 'required',
            'fecha_expedicion' => 'required',
            // 'fecha_vencimiento' => 'required',
            // 'fecha_nacimiento' => 'required',
            'edad' => 'required',
            'genero' => 'required',
            // 'estado_civil' => 'required',
            // 'telefono' => 'required',
            'celular' => 'required',
            // 'correo_electronico' => 'required',
            'departamento' => 'required',
            'ciudad' => 'required',
            'barrio' => 'required',
            'comuna' => 'required',
            'direcion' => 'required',
            // 'lat' => 'required',
            // 'let' => 'required',
            // 'actividad' => 'required',
            // 'ciudad_origen' => 'required',
            // 'pais_origen' => 'required',
            // 'fecha_llegada' => 'required',
            // 'intencion_ciudad' => 'required',
            // 'respuesta_intencion' => 'required',
            // 'discapacidad' => 'required',
            // 'salud' => 'required',
            // 'estudia_actualmente' => 'required',
            // 'nivel_escolaridad' => 'required',
            // 'trabajo' => 'required',
            // 'observaciones' => 'required',

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
            'tipo_documento.required' => 'es requerido',
            'numero_documento.required' => '',
        ];
    }
}
