<?php namespace App\Validators;

class PermissionUserValidator extends CustomValidator
{
    protected $rules = [
                            CustomValidator::RULE_METHOD_CREATE => [
                                'name' => 'required',
                                'label' => 'required',
                            ],

                            CustomValidator::RULE_METHOD_UPDATE => [
                                'permission' => 'required',
                                'can' => 'required',
                            ],
                        ];

    protected $messages = [
                                'permission.required' => 'O campo permissão é obrigatório',
                                'can.required' => 'O campo can é obrigatório',
                          ];


}