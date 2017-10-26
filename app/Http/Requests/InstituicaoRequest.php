<?php

namespace Casa\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InstituicaoRequest extends FormRequest 
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
            # Instituição
            'razao_social'       => 'required|regex:/^[\pL\s\-]+$/u',
            'endereco'           => 'required',
            'endereco_numero'    => 'required',
            'cidade'             => 'required',
            'bairro'             => 'required',
            'cep'                => 'required',
            'email_instituicao'  => 'required|email|unique:instituicoes,email,'.$this->instituicao_id,
            'telefone'           => 'required',
            # Administrador
            'name'               => 'required|regex:/^[\pL\s\-]+$/u', 
            'cargo'              => 'required|regex:/^[\pL\s\-]+$/u',
            # Horário de Visitas
            'hora_inicio_visita' => 'required|before:hora_fim_visita',
            'hora_fim_visita'    => 'required|after:hora_inicio_visita',
        ];
    }

    public function messages() 
    {
        return [
            # Instituição
            'razao_social.required'       => '* A razão social é obrigatória.',
            'razao_social.regex'          => '* A razão social deve conter apenas letras e espaços.',
            'endereco.required'           => '* O endereço da instituição é obrigatório.',
            'endereco_numero.required'    => '* O número do endereço é obrigatório.',
            'cidade.required'             => '* A cidade da instituição é obrigatória',
            'bairro.required'             => '* O bairro da instituição é obrigatório.',
            'cep.required'                => '* O CEP da instituição é obrigatório.',
            'email_instituicao.required'  => '* O e-mail da instituição é obrigatório.',
            'email_instituicao,unique'    => '* O e-mail da instituição já está em uso',
            'telefone.required'           => '* O telefone da instituição é obrigatório.',
            # Administrador
            'name.required'               => '* O nome do administrador é obrigatório.',
            'name.regex'                  => '* O nome deve conter apenas letras e espaços.',
            'cargo.required'              => '* O cargo do administrador é obrigatório.',
            'email_adminstrador.required' => '* O e-mail do administrador é obrigatório.',
            'email_adminstrador.unique'   => '* O e-mail do administrador já está em uso.',
            'hora_inicio_visita.required' => '* O campo hora inicial de visita é obrigatório.',
            'hora_fim_visita.required'    => '* O campo hora final de visita é obrigatório.',
            # Horário de Visitas
            'hora_inicio_visita.before'   => '* O campo  de hora inicial deve ser um horário antes da hora final de visita.',
            'hora_fim_visita.after'       => '* O campo de hora final deve deve ser um horário depois de hora inicial visita',

        ];
    }
}
