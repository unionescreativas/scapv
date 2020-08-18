<?php

namespace Modules\Caracterizacion\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AyudaRequest extends FormRequest
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
            'lista_id' => 'required',
            'ciudadano_id' => 'required',
            'cantidad_entregada' => 'required|numeric',
            'fecha_entrega' => 'date|date_format:Y-m-d',
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
}
