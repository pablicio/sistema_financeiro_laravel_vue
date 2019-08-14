<?php namespace App\Validators;

class PermissionRoleValidator extends CustomValidator
{
    protected $rules = [
                            CustomValidator::RULE_METHOD_CREATE => [
                                'role_id' => 'required',
                                'permissions' => 'required',
                            ],

                            CustomValidator::RULE_METHOD_UPDATE => [
                                'role_id' => 'required',
                                'permissions' => 'required',
                            ],
                        ];

    protected $messages = [
                                'role_id.required' => 'O campo role é obrigatório',
                                'permissions.required' => 'É necessário informar as permissões que deseja cadastrar',
    ];


}