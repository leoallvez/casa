<?php

namespace Casa\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SolicitarCadastroRequest extends FormRequest {
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
            # Instituição
            'razao_social'          => 'required|regex:/^[\pL\s\-]+$/u',
            'cnpj'                  => 'required|cnpj|size:18|unique:instituicoes,cnpj', 
            'endereco'              => 'required',
            'endereco_numero'       => 'required',
            'cidade'                => 'required',
            'bairro'                => 'required',
            'cep'                   => 'required',
            'email_instituicao'     => 'required|email',
            'telefone'              => 'required',
            # Administrador
            'name'                  => 'required|regex:/^[\pL\s\-]+$/u', 
            'cpf'                   => 'required|cpf|size:14|unique:users,cpf',
            'cargo'                 => 'required|regex:/^[\pL\s\-]+$/u',
            'email_adminstrador'    => 'required|email|unique:users,email',
            'password'              => 'required|confirmed|min:8',
            'password_confirmation' => 'required|min:8'
        ];
    }
    public function messages() {
        return [
            # Instituição
            'razao_social.required'          => '* A razão social é obrigatória.',
            'razao_social.regex'             => '* A razão social deve conter apenas letras e espaços.',
            'cnpj.required'                  => '* O CNPJ é obrigatório.',
            'cnpj.cnpj'                      => '* CNPJ inválido.',
            'cnpj.unique'                    => '* CNPJ já está em uso.',
            'endereco.required'              => '* O endereço da instituição é obrigatório.',
            'endereco_numero.required'       => '* O número do endereço é obrigatório.',
            'cidade.required'                => '* A cidade da instituição é obrigatória',
            'bairro.required'                => '* O bairro da instituição é obrigatório.',
            'cep.required'                   => '* O CEP da instituição é obrigatório.',
            'email_instituicao.required'     => '* O e-mail da instituição é obrigatório.',
            'telefone.required'              => '* O telefone da instituição é obrigatório.',
            # Administrador
            'name.required'                  => '* O nome do administrador é obrigatório.',
            'name.regex'                     => '* O nome deve conter apenas letras e espaços.',
            'cpf.required'                   => '* O CPF é obrigatório.',
            'cpf.cpf'                        => '* O CPF inválido.',
            'cpf.unique'                     => '* CPF já está em uso.',
            'cargo.required'                 => '* O cargo do administrador é obrigatório.',
            'email_adminstrador.required'    => '* O e-mail do administrador é obrigatório.',
            'email_adminstrador.unique'      => '* O e-mail do administrador já está em uso.',
            'password.required'              => '* É obrigatório informar a senha.',
            'password.min'                   => '* A Senha deve ter no mínimo 8 caracteres.',
            'password.confirmed'             => '* A Senha e a confirmação não conferem.',
            'password_confirmation.required' => '* É obrigatório confirmar a senha.',
            'password_confirmation.min'                   => '* A confirmação da senha deve ter no mínimo 8 caracteres.'
        ];
    }
}
