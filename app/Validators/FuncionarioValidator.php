<?php namespace App\Validators;

class FuncionarioValidator extends CustomValidator
{
    protected $rules = [
                            CustomValidator::RULE_METHOD_CREATE => [
                                'estado' => 'required',
                                'cidade_id' => 'required',
                                'tipo_perfil_id' => 'required',
                                'nome' => 'required',
                                'email' => 'required',
                                'data_nascimento' => 'required',
                                'cpf' => 'required',
                                'cep' => 'required',
                                'endereco' => 'required',
                                'bairro' => 'required',
                            ],

                            CustomValidator::RULE_METHOD_UPDATE => [
                                'estado' => 'required',
                                'cidade_id' => 'required',
                                'tipo_perfil_id' => 'required',
                                'nome' => 'required',
                                'email' => 'required',
                                'data_nascimento' => 'required',
                                'cpf' => 'required',
                                'cep' => 'required',
                                'endereco' => 'required',
                                'bairro' => 'required',
                            ],
                        ];

    protected $messages = [
                                'estado.required' => 'O campo estado é obrigatório',
                                'cidade_id.required' => 'O campo cidade é obrigatório',
                                'tipo_perfil_id.required' => 'O campo tipo de perfil é obrigatório',
                                'nome.required' => 'O campo nome é obrigatório',
                                'email.required' => 'O campo email é obrigatório',
                                'data_nascimento.required' => 'O campo data de nascimento é obrigatório',
                                'cpf.required' => 'O campo cpf é obrigatório',
                                'cep.required' => 'O campo cep é obrigatório',
                                'endereco.required' => 'O campo endereço é obrigatório',
                                'bairro.required' => 'O campo bairro é obrigatório',
                           ];
}

