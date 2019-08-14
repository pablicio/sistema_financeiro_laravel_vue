<?php namespace App\Validators;

class ServicoValidator extends CustomValidator
{
    protected $rules = [
                            CustomValidator::RULE_METHOD_CREATE => [
                                'referencia' => 'required',
                                'nome' => 'required',
                                'valor' => 'required',
                            ],

                            CustomValidator::RULE_METHOD_UPDATE => [
                                'referencia' => 'required',
                                'nome' => 'required',
                                'valor' => 'required',
                            ],
                        ];

    protected $messages = [
                                'referencia.required' => 'O campo referência é obrigatório',
                                'nome.required' => 'O campo nome é obrigatório',
                                'valor.required' => 'O campo valor é obrigatório',
                          ];
}

