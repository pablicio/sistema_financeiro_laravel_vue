<?php namespace App\Validators;

class FornecedorValidator extends CustomValidator
{
    protected $rules = [
        CustomValidator::RULE_METHOD_CREATE => [
            'estado' => 'required',
            'cidade_id' => 'required',
            'tipo_fornecedor_id' => 'required',
            'cnpj' => 'required_without:cpf|required_with:razao_social',
            'cpf' => 'required_without:cnpj|required_with:nome',
            'rg' => 'required_with:nome',
            'razao_social' => 'required_without:nome|required_with:cnpj',
            'nome' => 'required_without:razao_social|required_with:cpf',
            'email' => 'required',
            'cep' => 'required',
            'endereco' => 'required',
            'bairro' => 'required',
        ],

        CustomValidator::RULE_METHOD_UPDATE => [
            'estado' => 'required',
            'cidade_id' => 'required',
            'tipo_fornecedor_id' => 'required',
            'cnpj' => 'required_without:cpf|required_with:razao_social',
            'cpf' => 'required_without:cnpj|required_with:nome',
            'rg' => 'required_with:nome',
            'razao_social' => 'required_without:nome|required_with:cnpj',
            'nome' => 'required_without:razao_social|required_with:cpf',
            'email' => 'required',
            'cep' => 'required',
            'endereco' => 'required',
            'bairro' => 'required',
        ],
    ];

    protected $messages = [
        'rg.required_with' => 'O campo rg é obrigatório quando o fornecedor for pessoa física',
        'cnpj.required_without' => 'O campo cnpj é obrigatório quando o fornecedor for pessoa jurídica',
        'cpf.required_without' => 'O campo cpf é obrigatório quando o fornecedor for pessoa física',

        'cnpj.required_with' => 'O campo cnpj é obrigatório quando o fornecedor for pessoa jurídica',
        'cpf.required_with' => 'O campo cpf é obrigatório quando o fornecedor for pessoa física',
        'razao_social.required_with' => 'O campo razao social é obrigatório quando o fornecedor for pessoa jurídica',
        'razao_social.required_without' => 'O campo razao social é obrigatório quando o fornecedor for pessoa jurídica',
        'nome.required_without' => 'O campo nome é obrigatório quando o fornecedor for pessoa física',
        
        'estado.required' => 'O campo estado é obrigatório',
        'cidade_id.required' => 'O campo cidade é obrigatório',
        'tipo_fornecedor_id.required' => 'O campo tipo de fornecedor é obrigatório',
        'email.required' => 'O campo email é obrigatório',
        'cep.required' => 'O campo cep é obrigatório',
        'endereco.required' => 'O campo endereço é obrigatório',
        'bairro.required' => 'O campo bairro é obrigatório',
    ];
}

