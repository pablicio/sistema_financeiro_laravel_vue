<?php namespace App\Validators;

class ContasAPagarValidator extends CustomValidator
{
    protected $rules = [
                            CustomValidator::RULE_METHOD_CREATE => [
                                'tipo_despesa_id' => 'required',
                                'centro_de_custo_id' => 'required',
                                'tipo_pagamento_id' => 'required',
                                'sub_tipo_pagamento_id' => 'required',
                                'fornecedor_id' => 'required',
                                'data_vencimento' => 'required',
                                'valor' => 'required',
                            ],

                            CustomValidator::RULE_METHOD_UPDATE => [
                                'tipo_despesa_id' => 'required',
                                'centro_de_custo_id' => 'required',
                                'tipo_pagamento_id' => 'required',
                                'sub_tipo_pagamento_id' => 'required',
                                'fornecedor_id' => 'required',
                                'data_vencimento' => 'required',
                                'valor' => 'required',
                            ],
                            CustomValidator::RULE_METHOD_DELETE => [
                                'conta_id' => 'unique:conta_contabil_valores,conta_id'
                            ],
                        ];

    protected $messages = [
                                'tipo_despesa_id.required' => 'O campo tipo de despesa é obrigatório',
                                'centro_de_custo_id.required' => 'O campo centro de custo é obrigatório',
                                'tipo_pagamento_id.required' => 'O campo tipo de pagamento é obrigatório',
                                'sub_tipo_pagamento_id.required' => 'O campo sub tipo de pagamento é obrigatório',
                                'fornecedor_id.required' => 'O campo fornecedor é obrigatório',
                                'data_vencimento.required' => 'O campo data de vencimento é obrigatório',
                                'valor.required' => 'O campo valor é obrigatório',
                                'conta_id.unique' => 'Essa categoria não pode ser excluída nem ser pai de outras categorias!',

    ];
}

