<?php namespace App\Validators;

class PermissionValidator extends CustomValidator
{
    protected $rules = [
                            CustomValidator::RULE_METHOD_CREATE => [
                                'name' => 'required',
                                'label' => 'required',
                            ],

                            CustomValidator::RULE_METHOD_UPDATE => [
                                'name' => 'required',
                                'label' => 'required',
                            ],
                        ];

    protected $messages = [
                                'name.required' => 'O campo nome é obrigatório',
                                'label.required' => 'O campo label é obrigatório',
                          ];


}