<?php

namespace Casa\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest {
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
            'name'     => 'required',
            'cpf'      => 'required|cpf|size:14|unique:users,cpf', #.$this->id,
            'cargo'    => 'required',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:8'
        ];
    }

    public function messages() {
        return [
            'name.required'      => 'O campo nome é obrigatório.',
            'cpf.cpf'            => 'Número de CPF inválido,',
            'cpf.required'       => 'O campo CPF é obrigatório.',
            'cpf.size'           => 'O campo CPF deve ter 14 caracteres.',
            'cpf.unique'         => 'CPF já cadastrado no sistema.',
            'email.required'     => 'O campo e-mail é obrigatório',
            'password.min'       => 'A Senha deve ter no mínimo 8 caracteres.',
            'password.confirmed' => 'A Senha e a confirmação não conferem.',
            'password.required'  => 'O campo senha é obrigatório.'
        ];
    }
}
