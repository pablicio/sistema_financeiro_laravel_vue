<?php namespace App\Validators;

use Illuminate\Support\Facades\Validator;

class CustomValidator extends Validator
{
    protected $rules = [];

    protected $messages = [];

    const
        RULE_METHOD_CREATE = 'create',
        RULE_METHOD_UPDATE = 'update',
        RULE_METHOD_DELETE = 'delete',
        RULE_METHOD_BOLETO = 'boleto',
        RULE_METHOD_INVOICE = 'geral',
        RULE_METHOD_CREDITO = 'cartao_credito',
        RULE_METHOD_DEBITO = 'cartao_debito',
        RULE_METHOD_CHEQUE = 'cheque',
        RULE_METHOD_DINHEIRO = 'dinheiro',
        RULE_METHOD_OFX = 'ofx',
        RULE_METHOD_FILTER = 'filter',
        RULE_METHOD_ASSOCIATE = 'associar';


    public function makeValidation($request, $method)
    {
        return parent::make($request, $this->rules[$method], $this->messages);
    }

}