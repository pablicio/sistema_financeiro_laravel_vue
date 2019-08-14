<?php namespace App\Validators;

class UserValidator extends CustomValidator
{
    protected $rules = [
        CustomValidator::RULE_METHOD_CREATE => [
            'nome' => 'required',
            'email' => 'required',
        ],


        CustomValidator::RULE_METHOD_UPDATE => [
            'nome' => 'required',
            'email' => 'required',
        ],
        CustomValidator::RULE_METHOD_UPDATE => [
            'nome' => 'required',
            'email' => 'required',
            'roles' => 'required',
            'password' => 'required|confirmed'
        ],
    ];

    protected $messages = [
        'nome.required' => 'O campo nome é obrigatório',
        'email.required' => 'O campo email é obrigatório',
        'roles.required' => 'Informe o papél do usário',
        'password.confirmed' => 'O campo senha é obrigatório, confirme',

    ];


}
