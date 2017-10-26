<?php

namespace Casa\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VinculoRequest extends FormRequest
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
            'adotante_id' => 'required'
        ];
    }

    public function messages() 
    {
        return [ 
            'adotante_id.required' => 'É obrigatório informar o adotante.'
        ];
    }
}
