<?php namespace App\Validators;

class CentrosDeCustoValidator extends CustomValidator
{
    protected $rules = [
        CustomValidator::RULE_METHOD_CREATE => [
            'descricao' => 'required',
        ],

        CustomValidator::RULE_METHOD_UPDATE => [
            'descricao' => 'required',
        ],
    ];

    protected $messages = [
        'descricao.required' => 'O campo descricao é obrigatório',
    ];
}

