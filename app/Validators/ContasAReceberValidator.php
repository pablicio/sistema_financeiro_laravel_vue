<?php namespace App\Validators;

class ContasAReceberValidator extends CustomValidator
{
    protected $rules = [
                            CustomValidator::RULE_METHOD_CREATE => [
                                'forma_de_pagamento_id' => 'required',
                                'unidade_id' => 'required',
                                'valor' => 'required|numeric|min:0',
                                'data_vencimento' => 'required',
                                'conta_id' => 'required',
                            ],

                            CustomValidator::RULE_METHOD_UPDATE => [
                                'forma_de_pagamento_id' => 'required',
                                'unidade_id' => 'required',
                                'valor' => 'required|numeric|min:0',
                                'data_vencimento' => 'required',
                                'conta_id' => 'required',
                            ],
                            CustomValidator::RULE_METHOD_DELETE => [
                                'conta_id' => 'unique:conta_contabil_valores,conta_id'
                            ],
                        ];

    protected $messages = [
                                'forma_de_pagamento_id.required' => 'O campo forma de pagamento é obrigatório',
                                'unidade_id.required' => 'O campo unidade é obrigatório',
                                'valor.min' => 'O campo valor deve ser igual ou maior que zero',
                                'valor.numeric' => 'O campo valor deve ser um numero',
                                'valor.required' => 'O campo valor é obrigatório',
                                'data_vencimento.required' => 'O campo data de vencimento é obrigatório',
                                'conta_id.required' => 'O campo conta contábil é obrigatório',
                                'conta_id.unique' => 'Essa categoria não pode ser excluída nem ser pai de outras categorias!',

    ];
}

