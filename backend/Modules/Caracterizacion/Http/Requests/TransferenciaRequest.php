<?php

namespace Modules\Caracterizacion\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransferenciaRequest extends FormRequest
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
            'ciudadano_id' => 'required',
            'familia_id' => 'required',
            'parentesco' => 'required'
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
