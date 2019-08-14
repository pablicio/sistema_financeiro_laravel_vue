<?php

namespace App\Validators;

class ContaContabilValidator extends CustomValidator
{
    public function __construct($array)
    {
        $this->rules =  array_merge($this->rules,['update' => $array]);
    }

    protected $rules = [
        CustomValidator::RULE_METHOD_CREATE => [
            'nome' => 'required',
            'conta_id' => 'unique:conta_contabil_valores,conta_id'
        ],

        CustomValidator::RULE_METHOD_UPDATE=> [
            'nome' => 'required',
        ],

        CustomValidator::RULE_METHOD_DELETE => [
            'conta_id' => 'unique:conta_contabil_valores,conta_id',
        ],

    ];

    protected $messages = [
        'nome.unique' => 'Já existe uma categoria com esse nome, escolha outro!',
        'conta_id.unique' => 'Você deve escolher uma categoria na conta contábil e não um tipo',
        'conta_id.required' => 'É obrigatorio escolher a categoria',

    ];
}

