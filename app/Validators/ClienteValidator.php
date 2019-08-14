<?php namespace App\Validators;

class ClienteValidator extends CustomValidator
{
    protected $rules = [
        CustomValidator::RULE_METHOD_CREATE => [
            'cnpj' => 'required_without:cpf|required_with:razao_social',
            'cpf' => 'required_without:cnpj|required_with:nome',
            'rg' => 'required_with:nome',
            'razao_social' => 'required_without:nome|required_with:cnpj',
            'nome' => 'required_without:razao_social|required_with:cpf',
            'estado' => 'required',
            'cidade_id' => 'required',
            'email' => 'unique:clientes',
            'cep' => 'required',
            'endereco' => 'required',
            'bairro' => 'required',
        ],

        CustomValidator::RULE_METHOD_UPDATE => [
            'cnpj' => 'required_without:cpf|required_with:razao_social',
            'cpf' => 'required_without:cnpj|required_with:nome',
            'rg' => 'required_with:nome',
            'razao_social' => 'required_without:nome|required_with:cnpj',
            'nome' => 'required_without:razao_social|required_with:cpf',
            'estado' => 'required',
            'cidade_id' => 'required',
            'email' => 'required',
            'cep' => 'required',
            'endereco' => 'required',
            'bairro' => 'required',
        ],
    ];

    protected $messages = [
        'rg.required_with' => 'O campo rg é obrigatório quando o cliente for pessoa física',
        'cnpj.required_without' => 'O campo cnpj é obrigatório quando o cliente for pessoa jurídica',
        'cpf.required_without' => 'O campo cpf é obrigatório quando o cliente for pessoa física',

        'cnpj.required_with' => 'O campo cnpj é obrigatório quando o cliente for pessoa jurídica',
        'cpf.required_with' => 'O campo cpf é obrigatório quando o cliente for pessoa física',
        'razao_social.required_with' => 'O campo razao social é obrigatório quando o cliente for pessoa jurídica',
        'razao_social.required_without' => 'O campo razao social é obrigatório quando o cliente for pessoa jurídica',
        'nome.required_without' => 'O campo nome é obrigatório quando o cliente for pessoa física',

        'estado.required' => 'O campo estado é obrigatório',
        'cidade_id.required' => 'O campo cidade é obrigatório',
        'nome.required' => 'O campo nome é obrigatório',
        'data_nascimento.required' => 'O campo data de nascimento é obrigatório',
        'cep.required' => 'O campo cep é obrigatório',
        'endereco.required' => 'O campo endereço é obrigatório',
        'bairro.required' => 'O campo bairro é obrigatório',
        'email.unique' => 'Este email já está cadastrado em nossa base de dados, escolha outro',

    ];
}



