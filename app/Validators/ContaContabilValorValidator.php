<?php namespace App\Validators;

class ContaContabilValorValidator extends CustomValidator
{


    protected $rules = [
        CustomValidator::RULE_METHOD_CREATE => [
            'conta_id' => 'unique:conta_contabil_valores,conta_contabil,conta_id',

        ],

        CustomValidator::RULE_METHOD_UPDATE => [
            'conta_id' => 'unique:conta_contabil_valores,conta_id'
        ],

        CustomValidator::RULE_METHOD_DELETE => [
            'conta_id' => 'unique:conta_contabil_valores,conta_id|unique:conta_contabil,conta_id',
        ],

    ];

    protected $messages = [
        'conta_id.unique' => 'Essa categoria não pode ser excluída nem ser pai de outras categorias!',
    ];
}

