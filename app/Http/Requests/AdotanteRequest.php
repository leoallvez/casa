<?php

namespace Casa\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class AdotanteRequest extends FormRequest 
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

        $regras = [
            # difereça de 16 com a idade do adotivo
            'nome'                      => 'required|regex:/^[\pL\s\-]+$/u',
            'estado_civil_id'           => 'required',
            'escolaridade_id'           => 'required',
            'categoria_profissional_id' => 'required',
            'telefone'                  => 'required',
            #id é um campo hidden no formulário.
            'cpf'                       => 'required|cpf|size:14|different:conjuge_cpf|unique:adotantes,cpf,'.$this->id.
            '|unique:adotantes,conjuge_cpf,'.$this->id,
            'rg'                        => 'required|different:conjuge_rg|unique:adotantes,rg,'.$this->id.
            '|unique:adotantes,conjuge_rg,'.$this->id,
            'nascimento'                => 'required|date|min:10|before:18 years ago|after:75 years ago',
            'email'                     => 'required|email|unique:adotantes,email,'.$this->id,
            'cep'                       => 'size:9'
        ];
        # Conjuge
        if($this->estado_civil_id == 2 || $this->estado_civil_id == 6) {
            $regras_conjuge = [
                'conjuge_nome'                      => 'required|regex:/^[\pL\s\-]+$/u',
                'conjuge_nascimento'                => 'required|date|min:10|before:18 years ago|after:75 years ago',
                'conjuge_cpf'                       => 'required|cpf|size:14|unique:adotantes,conjuge_cpf,'.$this->id.
                '|unique:adotantes,cpf,'.$this->id,
                'conjuge_rg'                        => 'required|unique:adotantes,conjuge_rg,'.$this->id.
                '|unique:adotantes,rg,'.$this->id,
                'conjuge_escolaridade_id'           => 'required',
                'conjuge_categoria_profissional_id' => 'required'
            ];
            $regras = array_merge($regras, $regras_conjuge);
        }
        return $regras;
    }

    public function messages() 
    {
        return [
            'nome.regex'                                 => 'O nome deve conter apenas letras e espaços.',
            'estado_civil_id.required'                   => 'O campo estado civil é obrigatório.',
            'nascimento.after'                           => 'O adotante deve ter no máximo 75 anos.',
            'nascimento.before'                          => 'O adotante deve ter 18 anos ou mais!',
            'nascimento.min'                             => 'A data de nascimento deve ser no formato: 00/00/0000.',
            'telefone'                                   => 'O campo telefone é obrigatório.',
            'cpf.cpf'                                    => 'CPF inválido.',
            'cpf.required'                               => 'O campo CPF é obrigatório.',
            'cpf.unique'                                 => 'CPF já está em uso.',
            'cpf.different'                              => 'CPF do adotante e do cônjuge devem ser diferentes.',
            'rg.required'                                => 'O campo RG é obrigatório',
            'rg.unique'                                  => 'O RG já está em uso.',
            'rg.different'                               => 'CPF do adotante e do cônjuge devem ser diferentes.',
            'escolaridade_id.required'                   => 'O campo escolaridade é obrigatório.',
            'categoria_profissional_id.required'         => 'O campo categoria profissional é obrigatório.',
            # Conjuge
            'conjuge_nome.regex'                         => 'O nome deve conter apenas letras e espaços.',
            'conjuge_nome.required'                      => 'Estado civil casado ou únião estavel, o nome do cônjuge é obrigatório',
            'conjuge_nome.alpha_spaces'                  => 'Nome do cônjuge deve conter somente letras.',
            'conjuge_nascimento.after'                   => 'O cônjuge deve ter no máximo 75 anos.',
            'conjuge_nascimento.required'                => 'Data de nascimento obrigatória',
            'conjuge_nascimento.before'                  => 'O cônjuge deve ter 18 anos ou mais!',
            'conjuge_nascimento.min'                     => 'A data de nascimento deve ser no formato: 00/00/0000.',
            'conjuge_cpf.cpf'                            => 'CPF inválido.',
            'conjuge_cpf.required'                       => 'O campo CPF é obrigatório.',
            'conjuge_cpf.unique'                         => 'CPF já está em uso.',
            'conjuge_rg.required'                        => 'O campo RG é obrigatório',
            'conjuge_rg.unique'                          => 'O RG já está em uso.',
            'conjuge_escolaridade_id.required'           => 'O campo escolaridade é obrigatório.',
            'conjuge_categoria_profissional_id.required' => 'O campo categoria profissional é obrigatório.',
        ];
    }
}
