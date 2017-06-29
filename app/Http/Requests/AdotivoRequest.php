<?php

namespace Casa\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class AdotivoRequest extends FormRequest
{
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
        # 'nascimento'  => depois: 18 anos atras.
        # 'data_chegada' => depois: nascimento.
        return [
            'nome'            => 'required|regex:/^[\pL\s\-]+$/u',
            'nascimento'      => 'required|date|min:10|after:18 years ago|before:today',
            'data_chegada'    => 'required|date|after:nascimento|before:tomorrow',
        ];
    }

    public function messages() {
        return [
            'nome.regex'          => 'O nome deve conter apenas letras e espaços.',
            'nascimento.after'    => 'O adotivo deve ter menos de 18 anos!',
            'nascimento.before'   => 'A data de nascimento deve ser uma data antes de hoje',
            'nascimento.min'      => 'A data de nascimento deve ser no formato: 00/00/0000.',
            'data_chegada.after'  => 'A data chegada deve ser uma data após o nascimento do adotivo!',
            'data_chegada.before' => 'A data chegada deve ser uma data antes de amanhã!',
        ];
    }
}
