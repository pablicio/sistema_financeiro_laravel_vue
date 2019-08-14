<?php namespace App\Validators;

class InvoiceValidator extends CustomValidator
{
    protected $rules = [
        CustomValidator::RULE_METHOD_CREATE => [
            'valor' => 'required|min:0',
            'tipo_invoice' => 'required',
        ],

        CustomValidator::RULE_METHOD_INVOICE => [
            'valor' => 'required|min:0',
            'tipo_invoice' => 'required',
        ],

        CustomValidator::RULE_METHOD_CHEQUE => [
            'valor' => 'required|min:0',
            'numero_cheque' => 'required',
            'banco_id' => 'required',
            'data_vencimento' => 'required',
        ],
        CustomValidator::RULE_METHOD_BOLETO => [
            'valor' => 'required|min:0',
            'data_vencimento' => 'required',
        ],
        CustomValidator::RULE_METHOD_CARTAO_CREDITO => [
            'valor' => 'required|min:0',
            'cartao_id' => 'required',
            'data_vencimento' => 'required',
        ],
        CustomValidator::RULE_METHOD_CARTAO_DEBITO => [
            'valor' => 'required|min:0',
            'cartao_id' => 'required',
            'data_vencimento' => 'required',
        ],

        CustomValidator::RULE_METHOD_DINHEIRO => [
            'valor' => 'required|min:0',
            'data_vencimento' => 'required',
        ]
    ];

    protected $messages = [
        'valor.required' => 'O campo valor é obrigatório',
        'valor.min' => 'O campo valor deve ser positivo',
        'tipo_invoice.required' => 'Selecione o tipo de Invoice',
        'data_vencimento.required' => 'O Campo data de Vencimento é obrigatório',
        'cartao_id.required' => 'Escolha o Cartão',
        'banco_id.required' => 'Escolha o Banco',
        'numero_cheque.required' => 'O Número do Cheque é obrigatório',
    ];


}