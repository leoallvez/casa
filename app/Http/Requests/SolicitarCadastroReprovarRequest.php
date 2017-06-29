<?php

namespace Casa\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SolicitarCadastroReprovarRequest extends FormRequest {
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'motivo_reprovacao' => 'required'
        ];
    }

    public function messages() {
        return [
            'motivo_reprovacao.required' => 'É obrigatório informar o motivo da reprovação.'
        ];
    }
}
