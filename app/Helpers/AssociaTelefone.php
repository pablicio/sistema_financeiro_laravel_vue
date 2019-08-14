<?php
/**
 * Created by PhpStorm.
 * User: Chronos Tecnologia
 * Date: 05/04/2017
 * Time: 10:02
 */

namespace App\Helpers;

class AssociaTelefone
{
    public static function associa($telefones, $entity)
    {
        foreach ($telefones as $id => $phone)
            if ($phone) {
                $entity->telefones()->updateOrCreate(
                    [
                        'id' => $id
                    ],
                    [
                        'telefone' => $phone['telefone']
                    ]);
            }
    }

}