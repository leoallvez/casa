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
            'razao_social'          => 'required',
            'cnpj'                  => 'required|cnpj|size:18|unique:instituicoes,cnpj', 
            'endereco'              => 'required',
            'endereco_numero'       => 'required',
            'cidade'                => 'required',
            'bairro'                => 'required',
            'cep'                   => 'required',
            'email_instituicao'     => 'required|email',
            'telefone'              => 'required',
            # Administrador
            'name'                  => 'required', 
            'cpf'                   => 'required|cpf|size:14|unique:users,cpf',
            'cargo'                 => 'required',
            'email_adminstrador'    => 'required|email|unique:users,email',
            'password'              => 'required|confirmed|min:8',
            'password_confirmation' => 'required|min:8'
        ];
    }
    public function messages() {
        return [
            # Instituição
            'razao_social.required'          => '* A razão social é obrigatória.',
            'cnpj.required'                  => '* O CNPJ é obrigatório.',
            'cnpj.cnpj'                      => '* CNPJ inválido.',
            'cnpj.unique'                    => '* CNPJ já está em uso.',
            'endereco.required'              => '* O endereço da instistuição é obrigatório.',
            'endereco_numero.required'       => '* O número do endereço é obrigatório.',
            'cidade.required'                => '* A cidade da instistuição é obrigatória',
            'bairro.required'                => '* O bairro da instistuição é obrigatório.',
            'cep.required'                   => '* O CEP da instistuição é obrigatório.',
            'email_instituicao.required'     => '* O e-mail da instistuição é obrigatório.',
            'telefone.required'              => '* O telefone da instistuição é obrigatório.',
            # Administrador
            'name.required'                  => '* O nome do administrador é obrigatório.',
            'cpf.required'                   => '* O CPF é obrigatório.',
            'cpf.cpf'                        => '* O CPF inválido.',
            'cpf.unique'                     => '* CPF já está em uso.',
            'cargo.required'                 => '* O cargo do administrador é obrigatório.',
            'email_adminstrador.required'    => '* O e-mail do administrador é obrigatório.',
            'email_adminstrador.unique'      => '* E-mail adminstrador já está em uso.',
            'password.required'              => '* É obrigatório informar a senha.',
            'password.min'                   => '* A Senha deve ter no mínimo 8 caracteres.',
            'password.confirmed'             => '* A Senha e a confirmação não conferem.',
            'password_confirmation.required' => '* É obrigatório confirmar a senha.',
            'password_confirmation.min'                   => '* A confirmação da senha deve ter no mínimo 8 caracteres.'
        ];
    }
}
