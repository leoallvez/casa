<?php

namespace Casa\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RelatorioAdotivoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */

    public function rules()
    {
        return [
            'data_inicio' => 'required',
            'data_fim'    => 'required|after:data_inicio',
        ];
    }

    public function messages() 
    {
        return [
            'data_inicio.required' => 'A data inicial é obrigatória',
            'data_fim.required'    => 'A data final é obrigatória',
        ];
    }
}
